<?php
session_start();
require_once "../index/function.php";
login_checker();
$dbh = db_connect();

function confirm_product(){
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM products');
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        foreach ($result as $key => $value) {
            echo $value;
            if(!($key == "price")){
                echo ",";
            }
        }
		echo "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面(商品登録)</title>
    <link rel='stylesheet' href='./CSS/confirm.css'>
</head>
<body>
    <div class="center">
        <div class="script">
            <?php confirm_product()?>
        </div>    
        <div class="submit">
        <p>この内容で出力しますか？</p>
            <form action='../function/export_product.php' method='post'>
                <button class="button export_btn" type='submit' name='export'>出力</button>
            </form>
            <form action='../index/main_product.php' method='post'>
                <button class="button back_btn" >戻る</button>    
            </form>
        </div>
    </div>
</body>
</html>
