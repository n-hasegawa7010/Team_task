<?php

# 確認画面

# 入力画面のフォームから値を受け取る
$name = htmlentities($_POST['name'], ENT_QUOTES);
$tel = htmlentities($_POST['tel'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$class = htmlentities($_POST['class'], ENT_QUOTES);

# 未入力があればerror.phpに飛ぶ
if($name == '' || $tel == '' || $email == ''){
	# テキストには書いていませんが、header()を使うと、画面を切り替えることができます
	# フォーム送信された内容を保持して別の画面に切り替える時には、307を指定します
	header('Location: error.php', true, 307);
	exit();
}
#データベースに接続
$dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

try{
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($dbh == null){
    echo "接続に失敗しました。";
}else{

    # SQL文を定める
    $SQL ="
    INSERT INTO user(
	name,
	tel,
	email,
	course
    )
    VALUES (
	'$name',
	'$tel',
	'$email',
	'$class'
    )
    ";

    # SQL文の実行
    $dbh->query($SQL);
    }
}
catch (PDOException $e){
        echo "エラー内容：".$e->getMessage();
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
	<input type="button" value="トップページへ戻る" onclick="location.href='db_form.html';">
</body>

</html>

