<?php

// 後で入力画面でもプログラム処理をするので、php ファイルにしておく

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
			<input type="text" name="name" size="40">
		</p>
		<p>
			■メールアドレス<br>
			<input type="text" name="email" size="40">
		</p>
		<p>
			■コメント<br>
			<textarea name="comment" cols="50" rows="6"></textarea>
		</p>
		<input type="submit" value="送信する">
		<input type="hidden" name="mode" value="post">
	</form>
</body>

</html>
