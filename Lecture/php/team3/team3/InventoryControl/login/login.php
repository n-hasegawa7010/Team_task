<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
    <title>ログイン画面</title>
</head>

<body>
    <main>
        <form action="login_check.php" method="post">
            <h1>在庫管理アプリ<br>ログイン</h1>
            <div class="login_form_btm">
                <input type="id" name="login_name" placeholder="Name">
                <input type="password" name="login_password" placeholder="Password">
                <p>
                <?php
                    if(!empty($_SESSION["login_text"])){
                        echo $_SESSION["login_text"];
                        $_SESSION["login_text"] = "";
                    }
                ?>
                </p>
                <input type="submit" class="login_btn" value="ログイン">
            </div>
        </form>
        <form action="../signin/signin.php">
            <p>
                <input type="submit" value="新規登録" class="signin_btn">
            </p>
        </form>
    </main>
</body>
</html>
