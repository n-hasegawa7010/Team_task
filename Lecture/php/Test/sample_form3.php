<?php
$name = $_GET["name"];
$comment = $_GET["comment"];
$email = $_GET["email"];

//特殊文字を無害化
$comment = htmlentities($comment);

//改行コードを<br>に変換する
$comment = str_replace("\r\n", "<br>", $comment); 
$comment = str_replace("\r", "<br>", $comment); 
$comment = str_replace("\n", "<br>", $comment); 

echo <<< _FORM_
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>確認フォームPHP3</title>
</head>
<body>
   <p>
       ■お名前<br>
	  $name
   </p>
   <p>
       ■コメント<br>
       $comment
   </p>
</body>
</html>
_FORM_;
?>
