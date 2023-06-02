<?php
session_start();
require_once "../index/function.php";
login_checker();
$dbh = db_connect();

function export_purchase(){
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM purchase');
    $stmt->execute();    
    $time = time();
    $filename = '../CSV/purchase_' . $time . '.csv';
    
    if(!touch($filename)) {
        echo 'すでにファイルが存在します';
        exit;
    }else{
        if($fp = fopen($filename,'w+')) {
            while($rec = $stmt->fetch(PDO::FETCH_ASSOC)){
                fputcsv($fp, $rec);
            }
            if(!fclose($fp)) {
                echo 'ファイルを閉じるのに失敗しました';
                exit;
            }
        }else{
            echo 'ファイルの書き込みに失敗しました';
            exit;
        }
    }
    echo '<p>仕入れ情報の出力完了しました</p>';
    echo <<< _FORM_
    <p>
    <input type="button" class="button" onclick="location.href='../index/main_product.php'" value="ホームに戻る">
    </p>
    _FORM_;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>完了画面(仕入れ)</title>
    <link rel='stylesheet' href='./CSS/export.css'>
</head>
<body>
    <?php 
    export_purchase();
    ?>
</body>
</html>

