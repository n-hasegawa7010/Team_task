<?php

// 確認画面

// 入力画面のフォームから値を受け取る
$name = htmlentities($_POST['name'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$comment = htmlentities($_POST['comment'], ENT_QUOTES);

if($name == '' || $email == '' || $comment == ''){
	// テキストには書いていませんが、header()を使うと、画面を切り替えることができます
	// フォーム送信された内容を保持して別の画面に切り替える時には、307を指定します
	header('Location: error.php', true, 307);
	exit();
}
// $commet に含まれるすべての改行文字(\r\n,\n\r,\n および\r) 
// の前に<br/> あるいは<br>を挿入して返します。
$comment = nl2br($comment);

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
	<p>次の内容でよろしければ、送信ボタンを押してください。</p>
	<p>
		■お名前 ： <span><?php echo $name ?></span>
	</p>
	<p>
		■メールアドレス ： <span><?php echo $email ?></span>
	</p>
	<p>
		■コメント ： <span><?php echo $comment ?></span>
	</p>
	<form action="finish.php" method="post">
	<input type="button" value="戻る" onclick="history.back()">
	<input type="submit" value="送信">
	<input type="hidden" name="name" value="<?php echo $name; ?>">
	<input type="hidden" name="email" value="<?php echo $email; ?>">
	<input type="hidden" name="comment" value="<?php echo $comment; ?>">
	</form>
</body>

</html>
