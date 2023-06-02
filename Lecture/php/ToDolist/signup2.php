<?php

$new_name = htmlentities($_POST['new_name'],ENT_QUOTES);
$new_email = htmlentities($_POST['new_email'],ENT_QUOTES);
$new_passwprd = htmlentities($_POST['new_password'],ENT_QUOTES);

echo "お名前：{$new_name}<br>";
echo "メールアドレス：$new_email<br>";
echo "パスワード：$new_passwprd<br>";

echo "<p>こちらの内容でご登録いたしますか？</p>";

// データベースに内容を登録

?>

<!DOCTYPE html>
<html lang="ja">
    <form action="login.php">
        <input type="submit" value="送信">
    </form>

    <p>
        <a href="./signup.php">内容を修正</a>
    </p>
</html>