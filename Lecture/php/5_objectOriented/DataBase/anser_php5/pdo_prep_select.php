<?php

$name = "";
$tel = "";

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
    # プレースホルダーの利用
    $SQL = "SELECT * FROM user WHERE course = ? OR name = ? OR tel = ?";
    # ?の場所は後で入れ替える。

    # プリペアードステートメント
    $stmt = $dbh->prepare($SQL);

    # 変数に値をセット
    $data = array('Beginner');

    # SQL文の実行
    # execute(['★ここの内容が ? に入る'])そしてSelectで表示される。
    if($stmt->execute(['Normal',"$name","$tel"])){
      while($row = $stmt->fetch()){
        echo "<pre>";
        print_r($row);
        echo "</pre>";
      }
    }
  }
}catch (PDOException $e){
  echo('エラー内容：'.$e->getMessage());
  die();
}
$dbh = null;
