<!DOCTYPE HTML>
<html>
<head>
<title> セッション</title>
<meta charset="utf-8">
</head>
<body>
<p> ログアウトしました</p>
<a href="session.html">ログインページに戻る。</a>
<?php

session_start();

$_SESSION=array();
session_destroy();

?>
</body>
</html>
