<?php
session_start();
require_once "../index/function.php";
login_checker();
$dbh = db_connect();
add_purchase();

function add_purchase(){
    # POSTの受け渡し
    $product_id = htmlentities($_POST["product_id"], ENT_QUOTES, "utf-8");
    $stock = htmlentities($_POST["stock"], ENT_QUOTES, "utf-8");
    $date = htmlentities($_POST["date"], ENT_QUOTES, "utf-8");
    $note = htmlentities($_POST["note"], ENT_QUOTES, "utf-8");
    global $dbh;

    /* 💭 二重でif を使っていますが、もうちょっとシンプルに書けそうですね
     * または、エラーチェック用の関数に切り出してもよいかもしれません
     */
    # 未入力があった場合にエラー
    if($product_id  == "-" || $stock == "0" || $date == ""){
        if($product_id == "-"){
            $_SESSION["add_text"]="商品名が未入力です<br>";
        }
        if($stock == "0"){
            $_SESSION["add_text"].="仕入れ数が0です<br>";
        }
        if($date == ""){
            $_SESSION["add_text"] .="日付が未入力です<br>";
        }
        header('Location: ../index/main_purchase.php');
        die();
    }

    # 仕入れ情報の追加
    $stmt = $dbh->prepare('INSERT INTO purchase(product_id,quantity, date, note) VALUES (:product_id,:stock,:date,:note)');
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':note', $note);
    $stmt->execute();

    $_SESSION["add_text"] = "仕入れ情報を追加しました";
    $dbh = null;
    header('Location: ../index/main_purchase.php');
}
?>
