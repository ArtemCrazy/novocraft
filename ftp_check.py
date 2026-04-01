import ftplib

host = "artemc9o.beget.tech"
user = "artemc9o"
passwd = r'\y<*9_x1ND]"~{F&'

try:
    ftp = ftplib.FTP(host)
    ftp.login(user, passwd)
    print("Files in / :", ftp.nlst("/"))
    print("Files in /crazy.studio/public_html/ai/NovocraftD/wordpress/wp-content/themes/novocraft :", ftp.nlst("/crazy.studio/public_html/ai/NovocraftD/wordpress/wp-content/themes/novocraft"))
    ftp.quit()
except Exception as e:
    print(f"Error: {e}")
