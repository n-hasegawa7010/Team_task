<?php

/** PokeAPI のデータを取得する(URL末尾の数字はポケモン図鑑のID) */
$url = 'https://pokeapi.co/api/v2/pokemon/2/';
$response = file_get_contents($url);
// レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response, true);

// echo "ポケモン１番(フシギダネ)のデータ";
// print("<pre>");
// var_dump($data);
// print("</pre>");
// echo "<hr>";

print("<pre>");
var_dump($data['name']); // 名前
var_dump($data['sprites']['front_default']); // 正面向きのイメージ
var_dump($data['height']); // たかさ
var_dump($data['weight']); // おもさ

# 変数に格納
$name = $data['name'];
$img = $data['sprites']['front_default'];
$height = $data['height'];
$weight = $data['weight'];

print("</pre>");

echo "<hr>";

// /** PokeAPI のデータを取得する(id=11から20のポケモンのデータ) */
// $url = 'https://pokeapi.co/api/v2/pokemon/?limit=10&offset=0';
// $response = file_get_contents($url);
// // レスポンスデータは JSON 形式なので、デコードして連想配列にする
// $data = json_decode($response, true);

// // 取得結果をループさせてポケモンの名前を表示する
// print("<pre>");
// foreach($data['results'] as $key => $value){
//     // var_dump($data['sprites']['front_default']); // デフォルト正面
//     var_dump($value['name']);  // 名前
//     // var_dump($data['type']); // タイプ
//     // var_dump($data['height']); // たかさ
//     // var_dump($data['weight']); // おもさ
// }
// print("</pre>");
// echo "<hr>";
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokemonAPI</title>
</head>
<body>
    <header>
        <h1>ポケモン図鑑</h1>
    </header>
    
    <main>
        <p>
            なまえ：<?php echo $name."<br>"; ?>
            url：<?php echo $img."<br>"; ?>
            <img src="<?php echo $img // 正面向きのイメージ ?>" alt="ポケモン画像">
            <br>
            たかさ：<?php echo $height."<br>"; // たかさ ?>
            おもさ：<?php echo $weight."<br>"; // おもさ ?>
        </p>
    </main>

    <footer>
        <h1>ポケモン図鑑</h1>
    </footer>
</body>
</html>

