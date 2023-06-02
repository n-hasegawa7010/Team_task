<?php
session_start();
$id = $_SESSION["id"];
$title = htmlentities($_POST["title"]);
$detail = htmlentities($_POST["detail"]);

# データベースに接続
$dsn = 'mysql:host=localhost; dbname=php_todoapp; charset=utf8';
$user = 'testuser';
$pass = 'testpass';


# 接続失敗
try{
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($dbh == null){
    echo "接続に失敗しました。";

# 接続成功
}else{
    # SQL文を定める
    $SQL ="
    INSERT INTO tasks(
    title,
    detail,
    user_id
    )
    VALUES (
    '$title',
    '$detail',
    '$id'
    )
    ";

    # SQL文の実行
    $dbh->query($SQL);
    }
}catch (PDOException $e){
    echo('エラー内容：'.$e->getMessage());
    die();
}

$dbh = null;


?>


<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<style type="text/css">
	span {
		color: green;
	}
	</style>

	<title>確認フォーム</title>
</head>

<body>
    <p>
        ご登録ありがとうございました。  
    </p>
	<input type="button" value="メインページへ戻る" onclick="location.href='main.php';">
</body>

</html>