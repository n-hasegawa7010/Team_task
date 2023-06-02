<?php

$new_name = htmlentities($_POST['new_name'],ENT_QUOTES);
$new_email = htmlentities($_POST['new_email'],ENT_QUOTES);
$new_passwprd = htmlentities($_POST['new_password'],ENT_QUOTES);

echo "ご登録ありがとうございました。";
echo "<a href='login.php'>ログイン画面へ</a>";
?>