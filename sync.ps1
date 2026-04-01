# ftp_deploy_and_git.ps1
Write-Host "1. Deploying FTP..."
powershell -ExecutionPolicy Bypass -File ftp_deploy.ps1
Write-Host "2. Pushing to Git..."
git add .
git commit -m "Auto-sync update $(Get-Date -Format 'yyyy-MM-dd HH:mm')"
git push origin main
Write-Host "Done!"
