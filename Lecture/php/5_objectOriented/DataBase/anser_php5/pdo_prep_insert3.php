<?php

# データベースに接続
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
    $SQL = "INSERT INTO user (name, tel, email, course) VALUES (?, ?, ?, ?)";
    # プリペアードステートメント
    $stmt = $dbh->prepare($SQL);

    # bindParamでパラーメーターと変数を紐付け
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $tel);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $course);

    # 入力内容の指定
    $name = "鈴木太郎";
    $tel = "012-3456-7890";
    $email = "suzuki@mail.com";
    $course = "Professional";

    $stmt->execute($data);
    echo("userテーブルにデータを追加しました。");
  }
}catch (PDOException $e){
  echo('エラー内容：'.$e->getMessage());
  die();
}
$dbh = null;
