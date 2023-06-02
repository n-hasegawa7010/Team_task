<?php

#データベースに接続
$dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

try{
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if ($dbh == null){
    echo "接続に失敗しました。";
  }else{

    # SQL文の定義
    $SQL = "SELECT * FROM item";

    # SQL文の実行
    $stmt = $dbh->prepare($SQL);
    $stmt->execute();
    while($row = $stmt->fetch()){
      echo"<pre>";
      print_r($row);
      echo"</pre>";
    }
  }
}catch (PDOException $e){
  echo('エラー内容：'.$e->getMessage());
  die();
}
$dbh = null;
