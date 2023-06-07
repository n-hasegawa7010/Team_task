<?php

# データベースに接続
$dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
$user = 'testuser';
$pass = 'testpass';

try{
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($dbh == null){
        # エラーが起きたとき、ここは実行されずにcatch 内が実行
    }else{

    $SQL = <<<_SQL_
        CREATE TABLE userByPhp (
        user_id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100),
        tel VARCHAR(100),
        email VARCHAR(100),
        course VARCHAR(100)
        )
    _SQL_;

    $dbh->query($SQL);
    # query：データベースに対して処理内容($SQL)を送る操作
    echo("userByPhp テーブルを作成しました。");
    }
}catch (PDOException $e){
    echo(' エラー内容：'.$e->getMessage());
    die();
}
$dbh = null;
