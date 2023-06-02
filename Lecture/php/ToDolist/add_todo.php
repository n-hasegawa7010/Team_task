<?php
session_start();
// $name = $_SESSION["name"];
$id = $_SESSION["id"];

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todoの追加</title>
</head>
<body>
    <header>
        <h2>todoの追加画面</h2>
    </header>
    <main>
        <!-- 仮でmianに移動。本来は入力チェックをしてから画面遷移 -->
        <form action="add_todo_check.php" method="post">
            <table>
                <tr>
                    <td>件名</td>
                    <td><input type="text" name="title" id=""></td>
                </tr>
                <tr>
                    <td>詳細</td>
                    <td><textarea name="detail" rows="4" cols="40"></textarea><br></td>
                </tr>
            </table>
            <p>
                <input type="submit" value="追加">
            </p>
        </form>
    </main>
</body>
</html>