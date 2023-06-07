<?php
session_start();
require_once "../index/function.php";
$dbh = db_connect();
/* POSTデータがあるかをチェック
 * 両方入力されていれば判定を行い、なければエラーを表示します*/
if(! empty($_POST)){ # 未入力があった場合にエラー
    if($_POST['login_name'] == '' || $_POST['login_password'] == null){
        $_SESSION["login_text"] = "未入力の項目があります";
        $_SESSION["logged_in"] = false;
        header('Location: login.php');
        exit;
    }
    $post_name = htmlentities($_POST['login_name'], ENT_QUOTES);
    $pass = htmlentities($_POST['login_password'], ENT_QUOTES);
    $post_password = md5($pass);

    login($dbh, $post_name, $post_password);
    $dbh = null;
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
        $_SESSION["login_text"] = "ログイン完了";
        $_SESSION["delete_text"] = "";
        header('Location: ../index/main_product.php');
        exit;
    }else{
        $_SESSION["login_text"] = "IDまたはパスワードが違います。";
        header('Location: login.php');
        exit;
    }
}

?>
