<?php
echo <<<_BODY_
<h1>ヒアドキュメントとは？</h1>
<p>ヒアドキュメントは任意の区切り文字列を使って複数行に渉文字列を表示させるのに便利な仕組みです。</p>
_BODY_;

echo "\"Hello,World\"　\でエスケープ";
echo "<br>";
print "Hello,World";
echo "<br>";
echo 1.287e3;
echo "<hr>";

$cir = 3;
$anser = $cir*$cir*3.14;
echo "半径：{$cir}cm 円面積：{$anser}cm^2";
echo "<hr>";

// $ary = array(80,90,100);
// for($j = 0; $j < 3;$j++){
//     echo $ary[$j]."点\n";
// }

echo "<h3>連想配列</h3>";
$fruits_price = [
    "apple" => 100,
    "orange" => 150,
    "pear" => 300,
    "banana" => 200,
    "grape" => 400,
    "XXX" => 2000
];
$fruits_num = ["apple" => 2, "orange" => 4, "pear" => 3, "banana" => 5];
foreach($fruits_price as $key => $value){
    echo "果物：{$key}\n値段：{$value}円　";
}

echo "<br>";
echo "var_dump:";
echo "<pre>";
var_dump($fruits_price);
echo "</pre>";
echo "<hr>";

// 二項代入演算子(.=) 
echo "<h3>二項代入演算子</h3>";
$text = "";
for($i=1; $i <10 ; $i++){
    $text .= $i * $i. "<br>";
}
echo $text;
// $textに結果が全て格納されている状態。
echo "<hr>";

// 厳格比較の演算子
$a = 1;
$b = "1";

// 型まで一致している場合に true
echo "<h3>厳格比較の演算子</h3>";
echo "a === 1：";
if ($a === 1 ){
	echo "true";
} else {
	echo "false";
}

echo "<br>";

echo 'a === "1"：';
if ($a === "1" ){
	echo "true";
} else {
	echo "false";
}
echo "<br>";

echo "b == 1：";
if ($b == 1 ){
	echo "true";
} else {
	echo "false";
}

echo "<br>";

echo 'b == "1"：';
if ($b == "1" ){
	echo "true";
} else {
	echo "false";
}

echo "<hr>";


// プリインクリメント
echo "<h3>プリインクリメント</h3>";
$a = 3;
$b = $a++;
// この操作の後数字が増える。
$c = ++$a;
echo "b={$b},c={$c}";
echo "<hr>";

// 条件文(if文)
echo "<h3>条件文(if文)</h3>";
$t = 10;
if($t < 12){
    echo "Good Morning\n";
}elseif($t < 18){
    echo "Good Afternoon\n";
}else{
    echo "Good Evening\n";
}
echo "<hr>";

// 繰り返し構文(while,for文)
echo "<h3>繰り返し構文(while,for文)</h3>";
echo "<h4>while文(回数が決まってない時)</h4>";
$i = 3;
while($i > 0){
    echo $i." ";
    $i--;
}

echo "<h4>for文(回数が決まっている時)</h4>";
for($k = 1; $k <= 10; $k++){
    echo 2**$k ." ";
}


echo "<h4>foreach文</h4>";
echo "配列に対して<br>";
$fruits = array("banana","apple","peach","orenge","pineapple","stroberry");
foreach ($fruits as $index => $value) {
echo "$index : $value <br>";
}
echo "<br>";

echo "連想配列に対して<br>";
$price = [
    "banana" => 100,
    "apple" => 300,
    "orange" => 200
];
foreach($price as $index => $value){
    echo "$index : $value <br>";
}
echo "<hr>";


// 問題
echo "<h3>問題</h3>";
$point = array("sato" => 80, "ito" => 70, "kato" =>90);
$ave = ($point["sato"] + $point["ito"] + $point["kato"])/count($point);
echo "平均点：".$ave."点"."<br>";

$max_member = "";
$max_point = 0;

foreach($point as $index => $value){
    if($max_point < $value){
        $max_point = $value;
        $max_member = $index;
    }
}
echo "最高得点者は{$max_member}さん。点数は{$max_point}点";
echo "<hr>";

// 追加問題①
echo "<h3>追加問題①</h3>";
for($n = 1; $n<=100; $n++){
    if($n % 3 == 0 && $n % 5 == 0){
        echo "FizzBuzz($n) ";
    }elseif($n % 5 == 0){
        echo "Buzz($n) ";
    }elseif($n % 3 == 0){
        echo "Fizz($n) ";
    }else{
        echo "{$n} ";
    }
}
echo "<hr>";

// 追加問題②
echo "<h3>追加問題②</h3>";
for ($i=1; $i<=100; $i++){
	$output = "";
	$output .= ($i % 3 == 0) ? "Fizz" : "";
	$output .= ($i % 5 == 0) ? "Buzz" : "";
	$output .= ($output == "") ? $i : "";
	print("{$output} ");
}

?>
<!-- 全部php文なら「?>」はいらない。 -->