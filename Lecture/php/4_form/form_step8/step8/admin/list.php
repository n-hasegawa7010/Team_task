<?php

// お問い合わせ一覧表示

// 正しいパスワード
$correct_password = 'staff-only';

// POSTの送信内容に、password が含まれていない、またはパスワードが正しくない場合は、
// パスワード入力画面にリダイレクトする
if (!isset($_POST['password']) ||
	  $_POST['password'] !== $correct_password
) {
	header('Location: ./password.php', true, 307);
	exit();
}

// お問い合わせデータを格納する配列を宣言
$lines = [];

// CSV ファイルを読み込み
$file_handle = fopen('../data.csv', 'r+');

// CSVファイルを共有ロックする
flock($file_handle, LOCK_SH);

// CSVファイルの内容を読み込み
while ($data = fgetcsv($file_handle)) {
	// お問い合わせのデータは、配列に分かれて保存される
	$lines[] = $data;
}

// CSVファイルの共有ロックを解除する
flock($file_handle, LOCK_UN);

// CSVファイルを閉じる
fclose($file_handle);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>

	<h1>お問い合わせ内容一覧</h1>
	<table border="1">
		<thead>
			<th>名前</th>
			<th>メールアドレス</th>
			<th>お問い合わせ内容</th>
		</thead>
		<tbody>
			<?php
			  // 配列に保存したデータを一覧表示する
				foreach ($lines as $line) {
					// trタグを出力
					echo '<tr>';

					// 名前とメールアドレス、お問い合わせ内容を出力
					// データは、配列の0, 1, 2の要素として保存されている
					echo '<td>' . $line[0] . '</td>';
					echo '<td>' . $line[1] . '</td>';
					echo '<td>' . $line[2] . '</td>';

					// trタグを閉じる
					echo '</tr>';
				}
			?>
		</tbody>
	</table>

</body>

</html>
