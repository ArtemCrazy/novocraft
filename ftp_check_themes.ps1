$ftpHost = "ftp://artemc9o.beget.tech/crazy.studio/public_html/ai/NovocraftD/wordpress/wp-content/themes/"
$user = "artemc9o"
$pass = '\y<*9_x1ND]"~{F&'
$creds = New-Object System.Net.NetworkCredential($user, $pass)

$req = [System.Net.FtpWebRequest]::Create($ftpHost)
$req.Method = [System.Net.WebRequestMethods+Ftp]::ListDirectory
$req.Credentials = $creds
$response = $req.GetResponse()
$reader = New-Object System.IO.StreamReader($response.GetResponseStream())
While ($reader.Peek() -ne -1) {
    Write-Host $reader.ReadLine()
}
$reader.Close()
$response.Close()
