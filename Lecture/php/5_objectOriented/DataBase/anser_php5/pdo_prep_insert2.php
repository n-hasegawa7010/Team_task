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

    # 配列に値を一括でセット
    $data = array( '高橋太郎', '012-3456-7890', 'takahashi@mail.com', 'Normal');

    $stmt->execute($data);
    echo("userテーブルにデータを追加しました。");
  }
}catch (PDOException $e){
  echo('エラー内容：'.$e->getMessage());
  die();
}
$dbh = null;
