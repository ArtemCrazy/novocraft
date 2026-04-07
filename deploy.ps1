# ============================================================
# deploy.ps1 — заливает на сервер файлы из последнего коммита
# Использование: powershell -File deploy.ps1
#                powershell -File deploy.ps1 -All   (залить всю тему)
# ============================================================
param([switch]$All)

# Credentials читаются из локального файла deploy.config.ps1 (не в git)
$configFile = "$PSScriptRoot\deploy.config.ps1"
if (-not (Test-Path $configFile)) {
    Write-Host "Файл deploy.config.ps1 не найден." -ForegroundColor Red
    Write-Host "Создайте его по образцу deploy.config.example.ps1" -ForegroundColor Yellow
    exit 1
}
. $configFile   # загружает $ftpUser, $ftpPass, $ftpBase

$localBase = "$PSScriptRoot\novacraft-theme"

# --- Функция загрузки одного файла ---
function FtpUpload($localPath, $remotePath) {
    $dir = [System.IO.Path]::GetDirectoryName($remotePath)
    # Создаём папку если нужно
    try {
        $mk = [System.Net.FtpWebRequest]::Create($dir)
        $mk.Method = [System.Net.WebRequestMethods+Ftp]::MakeDirectory
        $mk.Credentials = New-Object System.Net.NetworkCredential($ftpUser, $ftpPass)
        $mk.UsePassive = $true
        $mk.GetResponse().Close()
    } catch {}

    $fs  = [System.IO.File]::OpenRead($localPath)
    $req = [System.Net.FtpWebRequest]::Create($remotePath)
    $req.Method = [System.Net.WebRequestMethods+Ftp]::UploadFile
    $req.Credentials = New-Object System.Net.NetworkCredential($ftpUser, $ftpPass)
    $req.UseBinary = $true; $req.UsePassive = $true
    $req.ContentLength = $fs.Length
    $rs  = $req.GetRequestStream()
    $buf = New-Object byte[] 32768
    while (($n = $fs.Read($buf, 0, $buf.Length)) -gt 0) { $rs.Write($buf, 0, $n) }
    $rs.Close(); $fs.Close()
    $req.GetResponse().Close()
}

# --- Определяем список файлов для загрузки ---
if ($All) {
    Write-Host "Режим: вся тема" -ForegroundColor Cyan
    $files = Get-ChildItem $localBase -Recurse -File | ForEach-Object {
        $_.FullName.Substring($localBase.Length + 1).Replace("\", "/")
    }
} else {
    Write-Host "Режим: файлы из последнего коммита" -ForegroundColor Cyan
    $changed = git -C $PSScriptRoot diff --name-only HEAD~1 HEAD --diff-filter=ACMR 2>$null
    if (-not $changed) {
        # Если один коммит — берём все файлы темы из него
        $changed = git -C $PSScriptRoot show --name-only --format="" HEAD 2>$null
    }
    $files = $changed |
        Where-Object { $_ -match "^novacraft-theme/" } |
        ForEach-Object { $_.Substring("novacraft-theme/".Length) }
}

if (-not $files) {
    Write-Host "Нет файлов темы для загрузки." -ForegroundColor Yellow
    exit
}

# --- Загружаем ---
$ok = 0; $fail = 0
foreach ($rel in $files) {
    $local  = Join-Path $localBase $rel.Replace("/", "\")
    $remote = "$ftpBase/$rel"
    if (-not (Test-Path $local)) {
        Write-Host "ПРОПУСК (нет локально): $rel" -ForegroundColor DarkGray
        continue
    }
    try {
        FtpUpload $local $remote
        Write-Host "OK  $rel" -ForegroundColor Green
        $ok++
    } catch {
        Write-Host "ERR $rel — $($_.Exception.Message)" -ForegroundColor Red
        $fail++
    }
}

Write-Host "`nЗагружено: $ok  Ошибок: $fail" -ForegroundColor Cyan
