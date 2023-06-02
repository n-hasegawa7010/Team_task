<?php
$name = htmlentities($_POST['name'], ENT_QUOTES);
$tel = htmlentities($_POST['tel'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$class = htmlentities($_POST['class'], ENT_QUOTES);

if($name == '' || $tel == '' || $email == ''){
	// テキストには書いていませんが、header()を使うと、画面を切り替えることができます
	// フォーム送信された内容を保持して別の画面に切り替える時には、307を指定します
	header('Location: error.php', true, 307);
	exit();
}else{
	header('Location: ../db_insert.php', true, 307);
	exit();
}

?>
