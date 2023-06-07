<?php
// 送信完了画面

// 確認画面から値を受け取る
$name = htmlentities($_POST['name'],ENT_QUOTES);
$email = htmlentities($_POST['email'],ENT_QUOTES);
$comment = htmlentities($_POST['comment'],ENT_QUOTES);

// csvに内容を保存する
$file_handle = fopen('data1.csv', 'a+');

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
	<style type="text/css">
	span {
		color: green;
	}
	</style>

	<title>送信完了フォーム</title>
</head>

<body>
    <p>
        ありがとうございました。
    </p>
	<p>
	<input type="button" value="トップページへ戻る" onclick="location.href='form.php';">
	</p>
	<p>
	<form action="list.php" method="post">
		<input type="submit" value="一覧を表示">
	</form>
	</p>
</body>

</html>
