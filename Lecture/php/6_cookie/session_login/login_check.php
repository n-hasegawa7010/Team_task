<?php

session_start();

// ユーザーがログイン済みかどうかを判定

if(
    !isset($_SESSION["name"]) ||
    !isset($_SESSION["password"])
){
    header("Location: session.html");
}


?>