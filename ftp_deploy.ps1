$user = 'artemc9o'
$pass = '\y<*9_x1ND]"~{F&'
$creds = New-Object System.Net.NetworkCredential($user, $pass)

$files = @("front-page.php", "functions.php", "style.css", "script.js", "header.php", "footer.php", "template-parts/contact-section.php", "inc/home-meta.php")
$localPath = "c:\Users\user\Documents\Projects\Novacraft\novacraft-theme\"

# Create directory first
try {
    $request = [System.Net.FtpWebRequest]::Create("ftp://artemc9o.beget.tech/crazy.studio/public_html/ai/NovocraftD/wordpress/wp-content/themes/novocraft/template-parts")
    $request.Credentials = $creds
    $request.Method = [System.Net.WebRequestMethods+Ftp]::MakeDirectory
    $response = $request.GetResponse()
    Write-Host "Directory created."
    $response.Close()
} catch {
    Write-Host "Directory already exists or could not be created."
}

foreach ($file in $files) {
    $uri = "ftp://artemc9o.beget.tech/crazy.studio/public_html/ai/NovocraftD/wordpress/wp-content/themes/novocraft/" + $file
    $webclient = New-Object System.Net.WebClient
    $webclient.Credentials = $creds
    try {
        $webclient.UploadFile($uri, $localPath + $file)
        Write-Host "Uploaded $file"
    } catch {
        Write-Host "Error uploading $file : $_"
    }
}
