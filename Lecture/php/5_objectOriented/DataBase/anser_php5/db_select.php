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

    # SQL文を定める
    $SQL = "SELECT * FROM user";
    $stmt = $dbh->prepare($SQL); 
    # SQLでのセキュリティ対策
    # JavaScriptの時と同じようにユーザの入力から操作されないようにする。

    # SQL文の実行と表示
    $stmt->execute();
    while($row = $stmt->fetch()){
      echo "<pre>";
      print_r($row);
      echo "</pre>";
    }
  }
}catch (PDOException $e){
  echo('エラー内容：'.$e->getMessage());
  die();
}
$dbh = null;
