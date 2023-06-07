<?php

/* session_end.php
 * セッションの終了処理サンプル
 */

/* 1. セッションの開始 */
session_start();

/* 2. セッション情報を空にする */
$_SESSION = [];

/* 3. セッションIDのCookieを破棄させる */
setcookie(session_name(), "", time() - 1, "/");

/* 4. session_destroy() でセッションを破棄 */
session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
</head>

<body>
	<h1>セッションを破棄する処理</h1>
	<p>利用されていたセッション情報を破棄しました。</p>
	<p><a href="session_control.php">こちら</a>のリンクから前のページに戻ると、再度セッションを生成します。</p>
</body>

</html>