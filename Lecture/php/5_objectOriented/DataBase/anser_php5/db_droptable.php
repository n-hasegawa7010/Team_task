<?php

#データベースに接続
$dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

try{
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if ($dbh == null){
    # エラーが起きたとき、ここは実行されずにcatch内が実行
  }else{

  # SQL文を定める
  $SQL = "DROP TABLE user";

  # SQL文の実行
  $dbh->query($SQL);
  echo "userテーブルを削除しました。";
  }
}catch (PDOException $e){
  echo "エラー内容：".$e->getMessage();
  die();
}
$dbh = null;
