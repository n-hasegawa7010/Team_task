<?php

// Post にpassword が含まれていたら、変数に格納する
if (isset($_POST['password'])) {
	$password = $_POST['password'];
} else {
	$password = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>パスワード入力画面</title>
</head>

<body>

	<h1>パスワード入力画面</h1>

	<form action="list.php" method="POST">

		<label for="">
			<input type="password" name="password" value="<?php echo $password; ?>">
		</label>

		<p>
			<input type="submit" value="一覧を表示">
		</p>

	</form>
</body>

</html>
