<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
    <form method="post" action="dir.php">
        <input type="text" name="filename">
        <input type="submit" name="submit" value=" 送信">
    </form>
</body>
</html>
<?php
if(array_key_exists('submit', $_POST)){
    $filename=$_POST['filename'];
    echo $file = 'html/' . $filename;
    if (file_exists($file) === true) {
        // サーバー上のファイルを読み込んで表示する。
        readfile($file);
    }
}