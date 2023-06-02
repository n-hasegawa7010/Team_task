<html lang="ja"></html>

<?php
// 接続設定を指定
$dsn = 'mysql:host=localhost; dbname= データベース名; charset=utf8';
$user = 'ユーザー名';
$pass = 'パスワード';

try{
    // データベースに接続
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($dbh == null){
        // ここに接続失敗時の処理を記述

    }else{
        // ここに接続成功時の処理を記述

    }
}catch (PDOException $e){
    echo " エラー："."DB接続に失敗しました";
    die();
}
// データベースへの接続解除
$dbh = null;
