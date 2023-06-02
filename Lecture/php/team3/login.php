<?php
session_start();

//session_idを持っていたら、main_productに飛ぶ。
if(isset($_SESSION["user_name"])){
   header("Location: ../index/main_product.php");
   exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>ログイン画面</title>
</head>

<body>
    <main>
        <form action="login_check.php" method="post">
            <h1>ログイン</h1>
            <div class="login_form_btm">
                <input type="id" name="login_name" placeholder="UserID">
                <input type="password" name="login_password" placeholder="Password">
                <p>
                <?php
                    if(!empty($_SESSION)){
                        echo $_SESSION["add_text"];
                        $_SESSION ="";
                    }
                ?>
                </p>
                <input type="submit" class="button" value="ログイン">
            </div>
        </form>
        <form action="../signin/signin.php">
            <p>
                <input type="submit" value="新規登録" class="button">
            </p>
        </form>
    </main>
</body>
</html>
