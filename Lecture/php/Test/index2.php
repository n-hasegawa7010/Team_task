<?php
// 例：rand関数
echo "<h3>例：rand関数</h3>";
$b = rand();
echo $b . "<br>";
$c = rand(1,6);
echo $c;

echo "<hr>";

// ユーザ定義関数
echo "<h3>ユーザ定義関数</h3>";
function tax($price){
    $tax_price = $price * 1.08;
    return $tax_price;
}
echo tax(3000)."円<br>";
echo tax(4500)."円<br>";

echo "<hr>";

// ビルトイン関数
echo "<h3>ビルトイン関数</h3>";
echo "<h4>ファイルの読み書き</h4>";

// greeting.txt を読み込みする(ハンドルをとる)
$file_handler = fopen("./greeting.txt","r");
$file_size = filesize("greeting.txt");

// 読み込んだファイルの内容を表示する
$content = fread($file_handler, $file_size);
echo $content."<br>";

// ファイルサイズの表示
echo "file size:".$file_size;
// ファイルをクローズする
fclose($file_handler);

echo "<hr>";

// Prectice1
echo "<h3>PRACTICE1</h3>";
// sample.txtをr+(読み書き)でオープン
$dat = fopen("./sample.txt","r+");
// 2行目で同時に編集ができないようにflockでロック
flock($dat , LOCK_EX);
// $dat=sample.txtの文字列を取得し、$countに代入
$count = fgets($dat); // ファイルを一行読み込む1だったら$count=1;
// $countに1を足す
$count = $count +1;
// rewind関数でカーソルを先頭に戻す
rewind($dat);
// fwrite関数を使って$countの値を$datを通してsample.txtに書き込む
fwrite($dat,$count);
// ロックの解除
flock($dat , LOCK_UN);
// ファイルクロース
fclose($dat);
// $countを表示
echo $count;

echo "<hr>";

// explode関数
echo "<h3>文字列操作</h3>";
echo "<h4>explode関数</h4>";
$data = "1,apple,150,25";
$id = explode(',',$data);
echo <<<  END
ID：$id[0]
名前：$id[1]
料金：$id[2]
個数：$id[3]
END;

echo "<br>";

echo "<h4>implode関数</h4>";
$data = array(1,"apple",150,25);
$string = implode(',',$data);
echo $string;

echo "<br>";

echo "<h4>sprintf関数</h4>";
$mon = 4;
$day = 1;
$mmdd = sprintf("%02d/%02d",$mon,$day);
echo "日付：$mmdd";

echo "<br>";

echo "<h4>str_replace関数</h4>";
// str_replace(置換前の文字列,置換後の文字列,対象の文字列)
$text = 'I love NY, I love Japan';
$str = str_replace('love','💖',$text);
echo $str;

echo "<br>";

// time関数
echo "<h3>配列制御</h3>";
echo "<h4>array_pop</h4>";
$char = array("A","B","C");
print_r($char);
echo "<br>";

$val = array_pop($char);
echo '$val：';
print_r($val);
echo "<br>";

print_r($char);
echo "<br>";

echo "<h4>array_push</h4>";
$char = array("A","B","C");
print_r($char);
echo "<br>";

$val = array_push($char,"D");
print_r($char);
echo "<br>";

echo "<h4>array_shift</h4>";
$char = array("A","B","C");
print_r($char);
echo "<br>";

$val = array_shift($char);
print_r($char);
echo "<br>";

echo "<h4>array_unshift</h4>";
$char = array("A","B","C");
print_r($char);
echo "<br>";

$val = array_unshift($char,"D");
print_r($char);
echo "<br>";

echo "<h4>ソート</h4>";
$char = array("A","B","C");
print_r($char);
echo "<br>";

$val = arsort($char);
print_r($char);
echo "<hr>";

echo "<h3>変数の局所化</h3>";
$data = 42;

function test(){
    # 局所化させる
    $data = 5;
    echo $data;
}
test();

echo "<br>";

echo $data; //ここがエラーの原因。
//test()の外で$dataを宣言すればエラーは出ない。

echo "<hr>";

echo "<h3>環境変数</h3>";
$agent = getenv("HTTP_USER_AGENT");
if(strpos($agent,"iPhone")==true || strpos($agent,"Android")==true){
    echo "スマホ用のサイトです。";
}else{
    echo "PC用のサイトです。";
}

echo "<hr>";

echo "<h3>PRACTICE2</h3>";
echo "<h4>追加課題2-1 合計と平均_1</h4>";
$file_handler = fopen("./numbers.txt","r");
$file_size = filesize("numbers.txt");

$sum = 0;
$n = 0;

if($file_handler){
    while($num = fgets($file_handler)){
        $sum += $num;
        $n += 1;
    }
}

echo "合計：{$sum}\n";
echo "平均：".$sum/$n;

fclose($file_handler);

// 追加課題2-2 合計と平均_2
echo "<h4>追加課題2-2 合計と平均_2</h4>";
$file_handler = fopen("./numbers2.txt","r");

$line = "";
$numbers = []; // 各行の数値を配列として保持する(explodeの返り値を取る)

$sum = 0; // 各行の合計値を保存する
$n = 0; // 値の数を保存

// fgetsで1行文のデータを読み込んで$strに保存
// ファイルの最後まで読んだらfalseが返る
while(($line = fgets($file_handler)) != false){
    // 1行分読み込んだ中にある数値を、スペースで分割して文字列配列にする
    $numbers = explode(" ",$line);
    $sum = 0;

    foreach($numbers as $value){
        $sum += (int)$value;
    }
    echo "合計：".$sum."\n";
    echo "平均：".$sum/count($numbers)."<br>";
}

fclose($file_handler);

// 追加課題3 単語の並び変え_1
echo "<h4>追加課題3 単語の並び変え_1</h4>";
$file_words = fopen("./word_list.txt","r");

$w = "";
$words = [];

while(($w = fgets($file_words)) != false){
    $words += explode(" ",$w);
}

sort($words);
foreach($words as $index => $value){
	print("{$index}:{$value}<br>");
}

fclose($file_words);

// 追加課題4 単語の並び変え_1
echo "<h4>追加課題4 単語の並び変え_4</h4>";
$file_words2 = fopen("./word_list.txt","r");

$w2 = "";
$words2 = [];

while(($w2 = fgets($file_words2)) != false){
    $words2 += explode(" ",$w2);
}

sort($words2);
$res = array_unique($words2);
sort($res);


foreach($res as $index => $value){
    print("{$index}:{$value}<br>");
}

fclose($file_words2);

?>