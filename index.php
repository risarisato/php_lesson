<?php
//初期設定について、C:\xampp\phpMyAdmin\config.inc.phpとhttp://localhost:8080/phpmyadmin/にパスワードつけた
//http://localhost:8080/phpmyadmin/ 管理者パネルに入る
//http://localhost:8080/bbs-yt/?username= 絞り込み
//echo $_POST["submitButton"];
//echo $_POST["username"];
//echo $_POST["comment"];

// タイムゾーンの設定
date_default_timezone_set("Asia/Tokyo");


// DBの配列を用意する、初期化
$comment_array = array();
$pdo = null;
$stmt = null;


// バリデーションエラーでDBに書き込まれないようにする変数
$error_messages = array();


// DB接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbs-yt', "root", "root");
    // try～catch文でもし、DB接続に失敗したらエラー文のcatchを実行する
} catch (PDOException $e) {
    // $eにあるgetMessageメソッドを取り出す
    echo $e->getMessage();
}

// 書き込むボタンを押したとき＝空ではないとき=>真になり、echoを実行する
if(!empty($_POST["submitButton"])) {

    // 名前のチェック=>名前が空欄のときに
    if(empty($_POST["username"])) {
       echo "名前が入力されていません";
       // $error_messagesが有る無しで判断できる
       $error_messages["username"] = "名前が入力されていません";
    }
    // コメントのチェック=>空欄のときに
    if(empty($_POST["comment"])) {
       echo "コメントがありません";
       // $error_messagesが有る無しで判断できる
       $error_messages["comment"] = "コメントがありません";
    }
    echo $_POST["username"];
    echo $_POST["comment"];

    // エラーメッセージがあるとDBに書き込まない
    if(empty($error_messages)) {
        // 日時と時間詳細の表示
        $postDate = date("Y-m-d H:i:s");

        // ボタンを押して、フォームに書いたものをDBに追加、表示する
        try{
            //SQLクエリの中でテーブル名とカラム名をバッククォーテーション（`）で囲む必要がある
            $stmt = $pdo->prepare("INSERT INTO `bbs-table` (`username`, `comment`, `postDate`) VALUES (:username, :comment, :postDate)");
            $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
            $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
            $stmt->bindParam(':postDate', $postDate, PDO::PARAM_STR);
            // 実行
            $stmt->execute();
        } catch (PDOException $e) {
            // $eにあるgetMessageメソッドを取り出す
            echo $e->getMessage();
        }
    }
}


// DBからコメントデータを取得する
$sql = "SELECT `id`, `username`, `comment`, `postDate` FROM `bbs-table`;";
$comment_array = $pdo->query($sql);

// DBの接続を閉じる
$pdo = null;

?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php掲示板</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="title">PHPで掲示板アプリ作成</h1>
    <hr>
    <div class="boardWrapper">
        <section>
            <!-- phpからのforeachをhtmlで実行して、名前とコメントと日付を取得 -->
            <?php foreach ($comment_array as $comment) : ?>
            <article>
                <div class="wrapper">
                    <div class="nameArea">
                        <span>名前：</span>
                        <p class="username"><?php echo $comment["username"]; ?></p>
                        <time>:<?php echo $comment["postDate"]; ?></time>
                    </div>
                    <p class="comment"><?php echo $comment["comment"]; ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </section>
        <form class="formWrapper" method="POST">
            <div>
                <!-- 書き込むボタンを押したときの属性は「submitButton」 -->
                <input type="submit" value="書き込む" name="submitButton">
                <label for="">名前:</label>
                <input type="text" name="username">
            </div>
            <div>
                <textarea class="commentTextArea" name="comment"></textarea>
            </div>
        </form>
    </div>
</body>
</html>