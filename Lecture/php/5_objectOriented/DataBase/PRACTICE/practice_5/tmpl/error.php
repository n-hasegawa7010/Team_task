<?php
$name = htmlentities($_POST['name'], ENT_QUOTES);
$tel = htmlentities($_POST['tel'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);

echo "<h2>エラーが発生しました</h2>";
if($name == '' || $tel == '' || $email == ''){
	echo "<style>p{color:red}</style><p>未入力の項目があります。</p>";
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