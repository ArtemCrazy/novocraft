$ftpHost = "ftp://artemc9o.beget.tech/crazy.studio/public_html/ai/NovocraftD/wordpress/test_error.php"
$user = "artemc9o"
$pass = '\y<*9_x1ND]"~{F&'
$creds = New-Object System.Net.NetworkCredential($user, $pass)

$localPath = "c:\Users\user\Documents\Projects\Novacraft\test_error.php"
$uri = New-Object System.Uri($ftpHost)
$webclient = New-Object System.Net.WebClient
$webclient.Credentials = $creds
$webclient.UploadFile($uri, $localPath)
Write-Host "Uploaded test_error.php"
