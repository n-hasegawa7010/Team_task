<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メイン画面</title>
</head>
<body>
    <main>
    </main>
</body>
</html>

<?php
session_start();
# 画面に表示する。メイン画面

# データベースに接続
$dsn = 'mysql:host=localhost; dbname=php_todoapp; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

$email_se = $_SESSION["email"];
$password_se = $_SESSION["password"];

# 接続失敗
try{
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($dbh == null){
    echo "接続に失敗しました。";

# 接続成功
}else{
    # email,passwordが一致するname,idの取得
    $name_db = "SELECT name , id FROM users WHERE email = ? AND password = ?";
    $stmt = $dbh -> prepare($name_db);

    if($stmt->execute(["$email_se","$password_se"])){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $name = "$row[name]";
        $id = "$row[id]";
        }
    }else{
        header("Location: error.php");
    }

    # idをセッションに追加
    $_SESSION["id"] = $id; 

    # nameをセッションに追加
    $_SESSION["name"] = $name;

    echo "<h2>Todolist</h2>";
    echo "<p>{$name} 様：ログイン中</p>";

    echo '
    <p>
    <form action="logout.php">
        <input type="submit" value="ログアウト">
    </form>
    </p>
    
    ';

    # todoの追加
    echo '
    <p>
    <form action="add_todo.php">
        <input type="submit" value="Todoの追加">
    </form>
    </p>
</form>
    ';


    # todoの追加
    echo '
    <p>
    <form action="###.php">
        <input type="submit" value="編集">
    </form>
    </p>
</form>
    ';
    echo "<hr>";

    # email,passwordが一致するtableの表示+削除
    echo "<table border='1'>";
    echo "<tr><th>id</th><th>題名</th><th>詳細</th><th>done</th></tr>";
    $SQL = "SELECT * FROM tasks WHERE user_id = ?";
    $stmt = $dbh -> prepare($SQL);
    if($stmt->execute(["$id"])){
        while($table = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>{$table['id']}</td>";
            echo "<td>{$table['title']}</td>";
            echo "<td>{$table['detail']}</td>";
            echo "<td>{$table['done']}</td>";
            echo "</tr>";
            // echo "<pre>";
            // print_r($table);
            // echo "</pre>";
        }
        echo "</table>";
    }

    # logout.phpに移動して、セッションをなくして、ログイン画面に戻る。
    // echo "
    //     <form action='logout.php' method='post'>
    //     <input type='submit' value='ログアウト'>
    //     </form>
    // ";






    }
}catch (PDOException $e){
    echo('エラー内容：'.$e->getMessage());
    die();
}

$dbh = null;

// $add_todo = <<<_html_
//         <form action="main.php" method="post">
//         <p>
//         件名<br>
//         <input type="text" name="title" id="">
//         </p>
        
//         <p>
//         詳細<br>
//         <textarea name="detail" rows="4" cols="40"></textarea>
//         </p>
//         <input type="submit" value="追加する">
//         </form>
// _html_;

// echo "$add_todo";

// // データベースからTodolistを読み取って、表示
// echo "<hr>";
// echo "<h2>以下にTodolistを表示</h2>";


?>


