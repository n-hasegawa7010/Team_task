<?php

session_start();
require_once "../index/function.php";
login_checker();
$dbh = db_connect();
complete_purchase();

function complete_purchase()
{
    global $dbh;
    $key = htmlentities($_POST["key"], ENT_QUOTES, "utf-8"); //id
    $id = htmlentities($_POST["complete_id"], ENT_QUOTES, "utf-8"); //product_id

    $stmt = $dbh->prepare('SELECT * FROM purchase WHERE id = :id;');
    $stmt->bindParam(':id', $key);
    $stmt->execute();
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);

    $stock = 0;
    $stock += $result1["quantity"];

    $stmt = $dbh->prepare('SELECT * FROM products WHERE id = :id;');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
    $stock += $result2["stock"];

    $stmt = $dbh->prepare('UPDATE products SET stock = :stock WHERE id = :id;');
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $stmt = $dbh->prepare('INSERT INTO mode(mode_id) VALUES (:mode_id);');
    $stmt->bindParam(':mode_id', $key);
    $stmt->execute();

    $_SESSION["delete_text"] = "商品「".$result2["name"]."」の入荷が完了しました";

    if(!is_array($_SESSION["complete_mode"])) {
        $_SESSION["complete_mode"]= [];
    }
    header('Location: ../index/main_purchase.php');
    exit;
}
