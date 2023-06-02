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
    $SQL = <<<_SQL_
INSERT INTO user(
	user_id,
	name,
	tel,
	email,
	course 
)
VALUES (
	1,
	'山田太郎',
	'012-3456-7890',
	'yamada@mail.com',
	'Beginner'
)
_SQL_;

    # SQL文の実行
    $dbh->query($SQL);
    echo("userテーブルにデータを追加しました。");
  }
}catch (PDOException $e){
  echo "エラー内容：".$e->getMessage();
  die();
}
$dbh = null;
