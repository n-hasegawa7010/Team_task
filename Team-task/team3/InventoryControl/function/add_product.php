<?php
session_start();
add_product();
function add_product(){
  $name = htmlentities($_POST["product_name"], ENT_QUOTES, "utf-8");
  $price = htmlentities($_POST["price"], ENT_QUOTES, "utf-8");
  
  $text = "";
  $dsn = 'mysql:host=localhost; dbname=team3; charset=utf8';
  $user = 'team3';
  $pass = 'team3';
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if ($dbh == null) {
    echo "接続に失敗しました。";
    die();
  } 
  if($name == "" || $price == "0"){
      if($name == ""){
          $text="名前が未入力です<br>";
      }
      if($price == "0"){
          $text .="値段が0です<br>";
      }
      $_SESSION["add_text"] = $text;
      header('Location: ../index/main_product.php');
      die();
  }
  
  $stmt = $dbh->prepare('SELECT stock,name FROM products WHERE name = :name');
  $stmt->bindParam(':name', $name);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if($result){
    // var_dump($result);
    // $stock = $result["stock"] + 1;
    // echo $stock;
    // $stmt = $dbh->prepare('UPDATE products SET stock = :stock WHERE name = :name;');
    // $stmt->bindParam(':stock', $stock);
    // $stmt->bindParam(':name', $result["name"]);
    // $stmt->execute();
    // $text = "商品「".$name."」を追加しました";
    $text = "商品名が重複しています";

  }else{
    $stmt = $dbh->prepare('INSERT INTO products(name, stock, price) VALUES (:name,:stock,:price)');
    $stock = 0;
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':price', $price);
    $stmt->execute();
    $text = "商品「".$name."」を追加しました";
  }
  $_SESSION["add_text"] = $text;
  header('Location: ../index/main_product.php');
  return 0;
}
?>
