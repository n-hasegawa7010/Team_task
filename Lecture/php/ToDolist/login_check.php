
<?php
session_start();

# formから、emailとpasswordを取得
$email = htmlentities($_POST['email'], ENT_QUOTES);
$pass = htmlentities($_POST['password'], ENT_QUOTES);
$password = md5($pass);

$db = "php_todoapp";

// # POST Check
// echo "email:{$email}<br>
// pass:{$pass}<br>
// password:{$password}";

// echo "<hr>";

# 未入力があった場合にエラー
if($email == '' || $password == ''){
    echo "<h2>エラーが発生しました</h2>";
	echo "<style>p{color:red}</style><p>未入力の項目があります。</p>";
    echo "<input type='button' value='ログイン画面に戻る' onclick='history.back()'>";
    die();
}

# データベースに接続
$dsn = "mysql:host=localhost; dbname={$db}; charset=utf8";
$user = 'testuser';
$pass = 'testpass';

try{
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($dbh == null){
    echo "接続に失敗しました。";

# 接続成功
}else{
    # SQL文を定める
    $SQL = "SELECT * FROM users WHERE email = ? AND password = ?";
    # プリペアードステートメント
    $stmt = $dbh->prepare($SQL);

    # SQL文の実行
    # メールアドレスとパスワードがあっているかどうかチェック
    
    # メールアドレス＆パスワードがあっている場合
    if($stmt->execute(["$email","$password"])){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $email = $row["email"];
        $password = $row["password"];
        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";
        # セッションに保存
        $_SESSION["email"] = $email; 
        $_SESSION["password"] = $password;
        header("Location:main.php");
    }
}else{
    echo "error";
}
}
}catch (PDOException $e){
        echo "エラー内容：".$e->getMessage();
        die();
}

$dbh = null;

?>