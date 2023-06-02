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
    $SQL =<<<_SQL_
	CREATE TABLE item (
	item_id	INT	AUTO_INCREMENT	PRIMARY KEY,
	item_name	VARCHAR(100),
	item_price	INT
	)
_SQL_;

    # SQL文の実行
    $stmt = $dbh->prepare($SQL);
    $stmt->execute();
    echo "SQL実行完了(問1)";
  }
}catch (PDOException $e){
  echo('エラー内容：'.$e->getMessage());
  die();
}
$dbh = null;
