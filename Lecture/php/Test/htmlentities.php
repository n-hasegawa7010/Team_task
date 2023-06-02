<html>
<head><title>htmlentities</title></head>
    <body>
        <form action="htmlentities.php" method="get">
        <input type="text" name="name">
        <input type="submit" value=" 送信">
        </form>
    </body>
</html>
<?php
$test = $_GET["name"];
$test2 = htmlentities($test, ENT_QUOTES, "UTF-8");

echo "<p> 無効化なし:{$test}</p>\n";
echo "<p> 無効化有り:{$test2}</p>";
?>
