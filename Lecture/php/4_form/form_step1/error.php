<?php
$name = htmlentities($_POST['name'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$comment = htmlentities($_POST['comment'], ENT_QUOTES);

echo "<h2>エラーが発生しました。</h2>";

if($name == ""){
	error("名前が未入力です<br>");
}

// メールアドレスの入力チェック
if ($email == '') {
	$message .= 'メールアドレスを入力してください。<br>';
}

if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
	error(" メールアドレスの形式が正しくありません。<br>");
}

if($comment == ""){
	error("お問い合わせ内容が未入力です！<br>");
}

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

	<title>エラー画面</title>
</head>

<body>
<input type="button" value="戻る" onclick="history.back()">    
</body>