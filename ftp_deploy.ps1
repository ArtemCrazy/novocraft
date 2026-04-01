$ftpHost = "ftp://artemc9o.beget.tech/crazy.studio/public_html/ai/NovocraftD/wordpress/wp-content/themes/novocraft/"
$user = "artemc9o"
$pass = '\y<*9_x1ND]"~{F&'
$creds = New-Object System.Net.NetworkCredential($user, $pass)

$files = @("front-page.php", "functions.php", "style.css", "script.js", "header.php", "footer.php")
$localPath = "c:\Users\user\Documents\Projects\Novacraft\novacraft-theme\"

foreach ($file in $files) {
    if (Test-Path ($localPath + $file)) {
        $uri = New-Object System.Uri($ftpHost + $file)
        $webclient = New-Object System.Net.WebClient
        $webclient.Credentials = $creds
        $webclient.UploadFile($uri, $localPath + $file)
        Write-Host "Uploaded $file"
    } else {
        Write-Host "File not found: $file"
    }
}
