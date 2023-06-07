<!DOCTYPE HTML>
<html>
<head>
<title> クッキー</title>
<meta charset="utf-8">
</head>
<body>
<p> ログアウトしました。</p>
<a href="cookie.html"> ログインページに戻る。</a>
<?php
    setcookie("name" , "john" ,time() - 100);
    setcookie("password" , 0123 ,time() - 100);
    // 現在よりも過去の時間を設定すると勝手にCookieが削除される。
?>
</body>
</html>