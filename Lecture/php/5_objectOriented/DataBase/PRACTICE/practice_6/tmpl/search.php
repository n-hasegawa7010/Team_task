<?php
$id = htmlentities($_POST['id'], ENT_QUOTES);
$name = htmlentities($_POST['name'], ENT_QUOTES);
$tel = htmlentities($_POST['tel'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$course = htmlentities($_POST['course'], ENT_QUOTES);

# 何もヒットしなかったらerror.phpに飛ぶ

#データベースに接続

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
    $SQL = "SELECT * FROM user WHERE user_id = ? OR name = ? OR tel = ? OR email = ? OR course = ?";
    # ?の場所は後で入れ替える。

    # プリペアードステートメント
    $stmt = $dbh->prepare($SQL);

    # 変数に値をセット
    $data = array('Beginner');

    # SQL文の実行
    # execute(['★ここの内容が ? に入る'])そしてSelectで表示される。
	if($stmt->execute(["$id","$name","$tel","$email","$course"])){
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
?>

<form action="../db_search.php">
  <input type="hidden" name="id">
  <input type="hidden" name="name">
  <input type="hidden" name="tel">
  <input type="hidden" name="email">
  <input type="hidden" name="course">
</form>