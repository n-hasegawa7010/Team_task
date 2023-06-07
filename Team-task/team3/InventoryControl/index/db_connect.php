<?php

function db_connect(){
    $dsn = 'mysql:host=localhost; dbname=team3; charset=utf8';
    $user = 'team3';
    $password = "team3";

    try {
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

function login_checker(){
    if (!isset($_SESSION["user_name"])) {
        header("Location: ../login/login.php");
        exit();
    }
}
