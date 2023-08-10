# php_lesson
## phpで掲示板をつくる
http://localhost:8080/bbs-yt/?username=


## 環境はXAMPP環境
C:\xampp\phpMyAdmin\config.inc.php
 と
http://localhost:8080/phpmyadmin/

パスワードつけないとPDOが読み込まなかった。


## MySQL起動エラー
Error: MySQL shutdown unexpectedly.
This may be due to a blocked port, missing dependencies,
improper privileges, a crash, or a shutdown by another method.
Press the Logs button to view error logs and check
the Windows Event Viewer for more clues
If you need more help, copy and post this
entire log window on the forums

#### XAMPPの「shell」から下記のコマンドを実行
- # aria_chk -r
- # del C:\xampp\mysql\data\aria_log.*