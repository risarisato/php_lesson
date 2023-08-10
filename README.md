## phpで掲示板をつくる
http://localhost:8080/bbs-yt/?username=

![image](https://github.com/risarisato/php_lesson/assets/88628553/a5422822-8d43-4e31-9808-693a8247caff)


## 環境はXAMPP環境
C:\xampp\phpMyAdmin\config.inc.php<br>
 と<br>
http://localhost:8080/phpmyadmin/<br>

パスワードつけないとPDOが読み込まなかった。


## MySQL起動エラー
Error: MySQL shutdown unexpectedly.<br>
This may be due to a blocked port, missing dependencies,<br>
improper privileges, a crash, or a shutdown by another method.<br>
Press the Logs button to view error logs and check<br>
the Windows Event Viewer for more clues<br>
If you need more help, copy and post this<br>
entire log window on the forums<br>

#### XAMPPの「shell」から下記のコマンドを実行
- aria_chk -r
- del C:\xampp\mysql\data\aria_log.*
