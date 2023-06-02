<?php
if(isset($_COOKIE["name"]) && isset($_COOKIE["password"])){
    echo "<p> ログイン中です。</p>";
    echo "<p> 現在は、{$_COOKIE["name"]} のアカウントです。</p>";
    echo '<p><a href="logout.php"> ログアウトします。</a></p>';
    exit;
}


$name = htmlentities($_POST["name"],ENT_QUOTES ,"utf-8");
$password = htmlentities($_POST["password"],ENT_QUOTES ,"utf-8");

if($name == "john" && $password == "0123"){
    setcookie("name", "john" , time()+3600);
    setcookie("password", 0123, time()+3600);

    echo "<p> ログイン成功。</p>";
    echo '<p><a href="login.php"> マイページに進む。</a></p>';

}else{
    echo '<p style="color:red;"> ログイン失敗。</p>';
    echo <<<_FORM_
    <form>
    <input type="button" value=" 前画面に戻る" onclick="history.back()">
    </form>
_FORM_;
}

?>
