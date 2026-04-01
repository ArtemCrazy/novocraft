import ftplib
import os

host = "artemc9o.beget.tech"
user = "artemc9o"
passwd = r'\y<*9_x1ND]"~{F&'
remote_dir = "/crazy.studio/public_html/ai/NovocraftD/wordpress/wp-content/themes/novocraft"
local_dir = r"c:/Users/user/Documents/Projects/Novacraft/novacraft-theme"

try:
    ftp = ftplib.FTP(host)
    ftp.login(user, passwd)
    
    # ensure directories exist, we only care about root files and template-parts right now
    def upload_dir(local, remote):
        try:
            ftp.cwd(remote)
        except:
            ftp.mkd(remote)
            ftp.cwd(remote)
        
        for item in os.listdir(local):
            local_path = os.path.join(local, item)
            remote_path = f"{remote}/{item}"
            if os.path.isfile(local_path):
                if local_path.endswith('.php') or local_path.endswith('.css') or local_path.endswith('.js'):
                    with open(local_path, 'rb') as f:
                        ftp.storbinary(f'STOR {item}', f)
                        print(f"Uploaded {item} to {remote}")
            elif os.path.isdir(local_path):
                upload_dir(local_path, remote_path)
                ftp.cwd(remote) # go back up

    ftp.cwd("/")
    upload_dir(local_dir, remote_dir)
    ftp.quit()
    print("ALL DONE")
except Exception as e:
    print(f"ERROR: {e}")
