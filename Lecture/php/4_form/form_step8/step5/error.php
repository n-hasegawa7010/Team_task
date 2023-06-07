<?php

// エラー表示画面

// 入力画面のフォームから値を受け取る
$name = htmlentities($_POST['name'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$comment = htmlentities($_POST['comment'], ENT_QUOTES);

// 画面に表示するエラーメッセージを保持する変数
$message = '';

// お名前の入力チェック
if ($name == '') {
	$message .= 'お名前を入力してください。<br>';
}

// メールアドレスの入力チェック
if ($email == '') {
	$message .= 'メールアドレスを入力してください。<br>';
}

// コメントの入力チェック
if ($comment == '') {
	$message .= 'コメントを入力してください。<br>';
}

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<style type="text/css">
	p.msg {
		color: red;
	}
	</style>
	<title>エラー</title>
</head>

<body>

	<p><b>エラーが発生しました。</b></p>
	<p class="msg"><?php echo $message;  ?></p>

	<form>
		<input type="button" value="前画面に戻る" onclick="history.back()">
	</form>

</body>

</html>
