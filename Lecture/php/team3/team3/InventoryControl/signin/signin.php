<?php
# データベースに新規登録

session_start();
require_once "../index/function.php";
$dbh = db_connect();

# POSTの受け渡し
if(! empty($_POST)){
    $new_name = htmlentities($_POST['new_name'], ENT_QUOTES);
    $new_password = htmlentities($_POST['new_password'], ENT_QUOTES);

    if($new_name == '' || $new_password == ''){    # 未入力があった場合にエラー
        $_SESSION["add_text"] = "未入力の項目があります";
        header('Location: signin.php?new_name=.$new_name. &new_password=.$new_password');
        exit;
    }

    validate_password($new_password); #パスワードは8文字以上、英語と数字じゃなければエラー
    $new_password = md5($new_password);

    match_name($dbh);
    # SQL文の実行
    $dbh->query("INSERT INTO users(
        name,
        password
        ) VALUES (
        '$new_name',
        '$new_password'
        )");
    login($dbh, $new_name, $new_password);
    $dbh = null;
}


function match_name($dbh){
    global $new_name;
    $stmt = $dbh->prepare('SELECT * FROM users WHERE name=?');
    $data = Array($new_name);
    $stmt_result = $stmt->execute($data);
    if($stmt->rowCount() > 0){
        $_SESSION["add_text"] = "同じ名前のユーザが存在します。";
        header('Location: signin.php?new_name=.$new_name. &new_password=.$new_password');
        exit;
        }
}

function validate_password($password){
    if(preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,}+\z/i',$password)){ //英語、数字をどちらも1文字以上含む8文字以上のパスワード
        #パスワードチェック完了
        return $password;
    }else if(preg_match('/^[a-zA-Z0-9]{8,}$/i', $password)==false){
        $_SESSION["add_text"] = $_SESSION["add_text"] . "パスワードが8文字以上ではありません。<br>";
    }else {
        $_SESSION["add_text"] = $_SESSION["add_text"] . "パスワードが英数字を含む文字列ではありません<br>";
    }
    header('Location: signin.php?new_name=.$new_name. &new_password=.$new_password');
    exit;
}

function login($dbh, $name, $password){
    $search_sql = "SELECT * FROM users WHERE name='$name' && password='$password'";
    $search_stmt = $dbh->prepare($search_sql);
    $search_result = $search_stmt->execute();
    $count = $search_stmt->rowCount();
    if($count == 1){
        $row = $search_stmt->fetch();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["user_name"] = $row["name"];
        $_SESSION["logged_in"] = true; 
        $_dbh = null;
        $_SESSION["add_text"] = "ログイン完了";
        $_SESSION["delete_text"] = "";
        header('Location: ../index/main_product.php');
        exit;
    }else{
        $_SESSION["add_text"] = "ログインに失敗しました。";
        header('Location: login.php');
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録画面</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <main>
        <h1>新規登録</h1>
        <form action="signin.php" method="post">
            <p class="name_ja">
                <input type="text" name="new_name" placeholder="Name">
            </p>
            <p class="pass_ja">
                <input type="password" name="new_password" placeholder="Password">
            </p>
            <div class="error_message">
            <p>
            <?php
                if(! empty($_SESSION["add_text"])){
                    echo $_SESSION["add_text"];
                    $_SESSION["add_text"] = "";
                }
            ?>
            </p>
            </div>
            <p>
            <input type="submit" value="登録" class="signin_btn">
            </p>
            <p>
        </form>
        <form action="../login/login.php">
            <p>
            <input type="submit" value="戻る" class="back_btn">
            </p>
        </form>
    </main>
</body>
</html>
