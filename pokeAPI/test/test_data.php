<?php
/** PokeAPI のデータを取得する(id=1から10のポケモンのデータ) */
$url = 'https://pokeapi.co/api/v2/pokemon/?limit=2&offset=0';
$response = file_get_contents($url);
// レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response, true);
// echo "ポケモンのデータ"."<br>";
// print("<pre>");
// var_dump($data);
// print("</pre>");
// echo "<hr>";

$i = 10;


/** PokeAPI のデータを取得する(URL末尾の数字はポケモン図鑑のID) */
$url = "https://pokeapi.co/api/v2/pokemon/{$i}/";
$response = file_get_contents($url);
// レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response, true);
echo "ポケモンの詳細API";
print("<pre>");
var_dump($data);
print("</pre>");

print("<pre>");
// var_dump($data['name']); // 名前
// echo "<hr>";
// var_dump($data['id']);
// var_dump($data['types']['0']['type']['name']);
// var_dump($data['types']['1']['type']['name']);
// var_dump($data['sprites']['front_default']); // 正面向きのイメージ
// var_dump($data['height']); // たかさ
// var_dump($data['weight']); // おもさ
print("</pre>");

$url = "https://pokeapi.co/api/v2/pokemon-species/{$i}/";
$response = file_get_contents($url);
// レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response, true);

echo "ポケモン_species";
print("<pre>");
var_dump($data);
print("</pre>");

// echo "ポケモン説明文";
// echo "<hr>";
print("<pre>");
// // var_dump($data['name']); // 名前
// var_dump($data['names']['0']['name']);
var_dump($data['flavor_text_entries']['62']['flavor_text']);
print("</pre>");

echo "<hr>";
$url = "https://pokeapi.co/api/v2/language/11/";
$response = file_get_contents($url);
// レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response, true);

echo "ポケモン_language";
print("<pre>");
var_dump($data);
print("</pre>");

?>