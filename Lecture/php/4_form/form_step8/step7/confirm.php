<?php

// 確認画面

// 入力画面のフォームから値を受け取る
$name = htmlentities($_POST['name'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$comment = htmlentities($_POST['comment'], ENT_QUOTES);

// 入力内容に問題があれば、エラー画面にリダイレクト（画面切り替え）する
if (
		$name == '' || // 名前が空欄の場合
		$comment == '' || // コメントが空欄の場合
		filter_var($email, FILTER_VALIDATE_EMAIL) === false // メールアドレスが不正な場合
	) {
    // テキストには書いていませんが、header()を使うと、画面を切り替えることができます
    // フォーム送信された内容を保持して別の画面に切り替える時には、307を指定します
    header('Location: error.php', true, 307);
    exit();
}

// 改行コードを<br>に変換する
// テキストでは \r\n, \n \r を順にstr_replace() で置換していましたが、
// PHP はこれ専用のビルトイン関数があるので、こちらをお勧めします
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

	<!-- 前に戻ったときに送信内容が保持できるように、form.php に対して入力内容を送信する -->
	<form action="form.php" method="post">
		<input type="hidden" name="name" value="<?php echo $name; ?>">
		<input type="hidden" name="email" value="<?php echo $email; ?>">
		<input type="hidden" name="comment" value="<?php echo $comment; ?>">
		<input type="submit" value="前に戻る">
	</form>

	<!-- CSV に保存する処理を実行する画面 send.php に対して入力内容を送信する -->
	<form action="send.php" method="post">
		<input type="hidden" name="name" value="<?php echo $name; ?>">
		<input type="hidden" name="email" value="<?php echo $email; ?>">
		<input type="hidden" name="comment" value="<?php echo $comment; ?>">
		<input type="submit" value="送信する">
	</form>
</body>

</html>
