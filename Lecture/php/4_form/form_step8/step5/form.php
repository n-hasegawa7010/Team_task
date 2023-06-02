<?php

// 後で入力画面でもプログラム処理をするので、php ファイルにしておく

// 入力画面のフォームから値を受け取る
// name, email, comment が $_POST に含まれているか(前の画面でフォーム送信されたか)を確認してから、
// それぞれの値を $name, $email, $comment に代入する
if (isset($_POST['name'])) {
	$name = htmlentities($_POST['name'], ENT_QUOTES);
} else {
	$name = null;
}
if (isset($_POST['email'])) {
	$email = htmlentities($_POST['email'], ENT_QUOTES);
} else {
	$email = null;
}
if (isset($_POST['comment'])) {
	$comment = htmlentities($_POST['comment'], ENT_QUOTES);
} else {
	$comment = null;
}

?>

<html>

<head>
	<meta charset="utf-8">
	<title>フォーム</title>
</head>

<body>
	<form action="confirm.php" method="post">
		<p>
			■お名前<br>
			<input type="text" name="name" size="40" value="<?php echo $name?>">
		</p>
		<p>
			■メールアドレス<br>
			<input type="text" name="email" size="40" value="<?php echo $email?>">
		</p>
		<p>
			■コメント<br>
			<!-- textarea は、 value 属性ではなく閉じタグとの間に入力内容を記入する -->
			<textarea name="comment" cols="50" rows="6"><?php echo $comment?></textarea>
		</p>
		<input type="submit" value="送信する">
		<input type="hidden" name="mode" value="post">
	</form>
</body>

</html>
