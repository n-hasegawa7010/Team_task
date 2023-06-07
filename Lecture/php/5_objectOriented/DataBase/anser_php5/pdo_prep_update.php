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
    # プレースホルダーの利用
    $SQL = "UPDATE item SET item_price = ? WHERE item_name=?";
    # プリペアードステートメント
    $stmt = $dbh->prepare($SQL);

    # 配列に値をセット
    $data = array('100','りんご');

    # SQL文の実行
    $stmt->execute($data);
    echo "SQL実行完了";
  }
}catch (PDOException $e){
  echo('エラー内容：'.$e->getMessage());
  die();
}
$dbh = null;
