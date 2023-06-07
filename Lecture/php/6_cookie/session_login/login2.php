<?php
require_once("login_check.php");
echo "<p>ログイン中です。</p>";
echo "<p>現在は{$_SESSION["name"]}のアカウントです。</p>";
echo '<p><a href="logout.php">ログアウトします。</a></p>';
exit;
?>