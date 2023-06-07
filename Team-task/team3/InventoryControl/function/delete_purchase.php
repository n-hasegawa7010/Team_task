<?php
session_start();
require_once "../index/function.php";
login_checker();
$dbh = db_connect();
delete_purchase();

/* 💬 仕入れ情報削除時に、在庫数の調整をした方がよさそうです */
function delete_purchase(){
  global $dbh;
  $id = htmlentities($_POST["delete_id"], ENT_QUOTES, "utf-8");
  var_dump($id);
  $stmt = $dbh->prepare('DELETE FROM purchase WHERE id = :id');
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $_SESSION["delete_text"] = "仕入れ情報を削除しました";
  header('Location: ../index/main_purchase.php');
  return 0;
}
?>
