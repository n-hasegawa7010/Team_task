<meta charset="UTF-8">
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

  $SQL = <<<_SQL_
INSERT INTO user (
	name,
	tel,
	email,
	course
)VALUES
('山田太郎', '012-3456-7890', 'yamada@yamada.com', 'Beginner'), 
('鈴木太郎', '012-3456-7891', 'suzuki@suzuki.com', 'Normal'), 
('田中太郎', '012-3456-7892', 'tanaka@tanaka.com', 'Professional'), 
('伊藤太郎', '012-3456-7893', 'ito@ito.com', 'Beginner'), 
('加藤太郎', '012-3456-7894', 'kato@kato.com', 'Normal'), 
('佐藤太郎', '012-3456-7895', 'sato@sato.com', 'Professional'), 
('西太郎', '012-3456-7896', 'nishi@nishi.com', 'other')
_SQL_;

  $dbh->query($SQL);
  echo "userテーブルにデータを追加しました。";
  }
}catch (PDOException $e){
  echo "エラー内容：".$e->getMessage();
  die();
}
$dbh = null;
