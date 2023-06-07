<?php
session_start();
# エンティティ化
$name = htmlentities($_POST["name"],ENT_QUOTES ,"utf-8");
$password = htmlentities($_POST["password"],ENT_QUOTES ,"utf-8");

# 暗号化
$password = hash("sha256" , $password);
// echo $password;

# $name, $passwordがあっていれば
# ハッシュ化を行うことで、ハッシュ化後の値が流出しても、パスワードを特定することは困難になる。
if($name == "Rsasaki" && $password ==
"79d9d8f002c1c955fa0d21eeaaf2ebf03c3a878d2fdcb6e78d915b3ed81cc886"){

    $_SESSION["name"] = $name;
    $_SESSION["password"] = $password;

    echo "<p> ログイン成功。</p>";

    # login3.phpへ
    echo '<p><a href="login3.php"> マイページに進む。</a></p>';

# $name, $passwordがあっていなければ
}else{
    echo '<p style="color:red;"> ログイン失敗。</p>';
    echo <<<_FORM_
    <form>
        <input type="button" value=" 前画面に戻る" onclick="history.back()">
    </form>
_FORM_;
}
