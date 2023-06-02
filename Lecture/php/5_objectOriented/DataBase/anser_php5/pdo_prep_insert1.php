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
    #INSERT文の定義
    $sql = "INSERT INTO user (name, tel, email, course) VALUES (:name, :tel, :email, :course)";
    # プリペアードステートメント
    $stmt = $dbh->prepare($sql);

    #bindParamによるパラメータ－と変数の紐付け
    $stmt -> bindParam(':name',$name);
    $stmt -> bindParam(':tel',$tel);
    $stmt -> bindParam(':email',$email);
    $stmt -> bindParam(':course',$course);

    #入力内容の指定
    $name = "山田太郎";
    $tel = "123-4578-8910";
    $email = "yamada@mail.com";
    $course = "Professional";

    #INSERTの実行
    $stmt->execute();
    echo("userテーブルにデータを追加しました。");
  }
}catch (PDOException $e){
  echo('エラー内容：'.$e->getMessage());
  die();
}
$dbh = null;
