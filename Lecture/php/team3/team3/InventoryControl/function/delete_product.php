<?php
session_start();
require_once "../index/function.php";
login_checker();
$dbh = db_connect();
delete_product();

/* 💬 商品削除時に、その商品の在庫データも削除するかどうかを検討してみてください
 * 大きな問題にはならないと思いますが、在庫データのCSV出力に削除済み商品の仕入れ情報が含まれてしまうと思われます
 */
function delete_product(){
  global $dbh;
  $id = htmlentities($_POST["delete_id"], ENT_QUOTES, "utf-8");
  var_dump($id);
  $stmt = $dbh->prepare('DELETE FROM products WHERE id = :id');
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $_SESSION["delete_text"] = "商品を削除しました";
  header('Location: ../index/main_product.php');
  return 0;
}
?>
