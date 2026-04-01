$ftpHost = "ftp://artemc9o.beget.tech/crazy.studio/public_html/ai/NovocraftD/wordpress/wp-content/themes/novocraft/"
$user = "artemc9o"
$pass = '\y<*9_x1ND]"~{F&'
$creds = New-Object System.Net.NetworkCredential($user, $pass)

$uri = New-Object System.Uri($ftpHost + "front-page.php")
$webclient = New-Object System.Net.WebClient
$webclient.Credentials = $creds
$content = $webclient.DownloadString($uri)
$content | Out-File "c:\Users\user\Documents\Projects\Novacraft\remote_front_page.txt"
Write-Host "Downloaded front-page.php"
