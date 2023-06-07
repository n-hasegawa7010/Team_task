<?php
session_start();
# name, passwordが入力されていれば以下
if(isset($_SESSION["name"]) && isset($_SESSION["password"])){
    echo "<p>ログイン中です。</p>";
    echo "<p>現在は{$_SESSION["name"]}のアカウントです。</p>";
    echo "<p>PRACTICE3で作成したページです。</p>";
    echo '<p><a href="logout.php">ログアウトします。</a></p>';
}else{
    header("Location: session.html");
}

?>