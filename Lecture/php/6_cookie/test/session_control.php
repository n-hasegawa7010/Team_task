<?php 

/* session_control.php
 * セッションの動作サンプル
 * 名前と訪問回数を記録する
 */

$user_name = null; /* $_COOKIEからユーザー名を取得する変数 */
$visit_count = 0; /* $_COOKIEから訪問回数を取得する変数 */

/* 1. セッションを開始
 * session_start()を実行すると、$_SESSION を利用できるようになる
 * このとき、自動的にセッションIDが生成・読込みされる
 */
session_start();

/* 2. $_SESSIONに値があるかを確認
 * $_SESSION の値を確認、データが入っているか(すでにセッションを利用していたか)
 * $_SESSION に値が入っていれば変数に保存
 */
if (isset($_SESSION["user_name"])) {
	/* user_nameの値が$_COOKIEにある場合、変数に保存する */
	$user_name = $_SESSION["user_name"];
} else {
	/* 値が無ければ、「名称未設定」にする */
	$user_name = "名称未設定";
}
if (isset($_SESSION["visit_count"])) { /* $_COOKIEに値が保存されている場合 */
	if ((int)$_SESSION["visit_count"] >= 1) {
		/* 値が入っていて、1より大きい数値であれば訪問回数を1増やす */
		$visit_count = (int)$_SESSION["visit_count"] + 1;
	} else {
		/* 1より小さかった場合、1を設定する */
		$visit_count = 1;
	}
} else { /* $_COOKIEに値が保存されていなかった場合 */
	/* 1を設定する */
	$visit_count = 1;
}

/* 2. POSTデータを確認し、内容が更新できる場合は更新する */
if (isset($_POST["user_name"])) { /* POST にuser_name が含まれていた場合 */
	/* ユーザーが画面上から入力した値に、user_nameを更新する */
	if ($_POST["user_name"] === "") {
		/* 空っぽの文字列を送信されていたら、「名称未設定」にする */
	} else {
		/* それ以外で、内容が入力されていたらその値に変更 */
		$user_name = $_POST["user_name"];
	}
}

/* 3. セッション情報 を保存しなおす */
$_SESSION["user_name"] = $user_name; /* user_name を設定 */
$_SESSION["visit_count"] = (string)$visit_count; /* visit_count を設定 */

/* 4. 画面描画を行う */
/* 後はHTMLを出力するだけ。値を埋め込みたい部分で、部分的に <?php echo %[変数名]; ?>と書く。
 */
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
</head>

<body>
	<h1>訪問回数のカウントページです！(セッション情報利用版)</h1>
	<p>
		<?php echo htmlspecialchars($user_name, ENT_QUOTES, "utf-8"); ?> さん、ようこそ～～！！
	</p>
	<p>
		あなたは、<?php echo htmlspecialchars($visit_count, ENT_QUOTES, "utf-8"); ?> 回目のご訪問です。
	</p>
	<p>
		お名前を変更する場合は、以下に入力して「変更」ボタンをクリックして下さい。
	</p>

	<h2>セッションデータをダンプする</h2>
	<div>
		<pre><?php var_dump($_SESSION); ?></pre>
	</div>

	<h2>名前情報の変更</h2>
	<form action="" method="POST" name="change_name">
		<input type="text" name="user_name" value="<?php echo htmlspecialchars($user_name, ENT_QUOTES, "utf-8"); ?>"><br>
		<input type="submit" name="send" value=" 変更 ">
	</form>

	<h2>セッションを破棄する</h2>
	<?php
		if (isset($_COOKIE[session_name()])){
			print ("<p>現在のセッションIDは、". htmlspecialchars($_COOKIE[session_name()]). " です</p>");
		}
	?>
	<p><a href="session_end.php">session_end.php で処理します</a></p>
</body>

</html>