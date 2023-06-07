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
    $SQL = "
    INSERT INTO
    user (name,tel,email,course)
    VALUES
    ('one_of_users','012-3456-7890', 'jiro@example.com','Normal'),
    ('one_of_users','012-3456-7890', 'jiro@example.com','Master'),
    ('one_of_users','012-3456-7890', 'jiro@example.com','Beginner'),
    ('one_of_users','012-3456-7890', 'jiro@example.com','Legend')
    ";

    # SQL文の実行
    $dbh->query($SQL);
    echo("userテーブルにデータを追加しました。");
  }
}catch (PDOException $e){
  echo('エラー内容：'.$e->getMessage());
  die();
}
$dbh = null;
