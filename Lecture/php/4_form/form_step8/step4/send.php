<?php

// 送信画面

// 確認画面のフォームから値を受け取る
$name = htmlentities($_POST['name'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$comment = htmlentities($_POST['comment'], ENT_QUOTES);

// csvに内容を保存する
$file_handle = fopen('data.csv', 'a+');

// ファイルを排他ロックする
flock($file_handle, LOCK_EX);

// ファイルに書き込む。CSV形式なので、書き込み内容はカンマ区切りの1行にする
fwrite($file_handle, $name . ',' . $email . ',' . $comment . "\n");

// ファイルの排他ロックを解除する
flock($file_handle, LOCK_UN);

// ファイルを閉じる
fclose($file_handle);

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>送信完了</title>
</head>

<body>

	<p>ありがとうございました。</p>
	<form>
		<input type="button" value="トップへ戻る" onclick="location.href='form.php';">
	</form>

</body>

</html>
