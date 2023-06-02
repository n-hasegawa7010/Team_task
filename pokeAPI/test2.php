<?php
/** PokeAPI のデータを取得する(id=1から10のポケモンのデータ) */
$url = 'https://pokeapi.co/api/v2/pokemon/?limit=2&offset=0';
$response = file_get_contents($url);
// レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response, true);
echo "ポケモンのデータ"."<br>";
print("<pre>");
var_dump($data);
print("</pre>");
echo "<hr>";