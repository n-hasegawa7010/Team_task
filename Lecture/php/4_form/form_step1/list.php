<?php
echo "<h1>お問い合わせ内容一覧</h1>";
$file_data_read = fopen("./data1.csv","r");

$line = ""; // 
$datas = []; // 文字列を格納する場所
$i = 1; // お問い合わせ順番

while(($line = fgets($file_data_read)) != false){
    echo "{$i}：{$line}<br>";
    $i += 1;
    //     $datas = explode("<br>",$line);
    //     foreach($datas as $index => $values){
    //         print("{$index}:{$values}<br>"); 
    //     }
}

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<style type="text/css">
	span {
		color: green;
	}
	</style>

	<title>お問い合わせ内容一覧</title>
</head>

<body>
    <p>
        <input type="button" value="トップページへ戻る" onclick="location.href='form.php';">
    </p>
    
</body>

</html>
