<?php

/** PokeAPI のデータを取得する(id=1から10のポケモンのデータ) */
$url = 'https://pokeapi.co/api/v2/pokemon/?limit=20&offset=10';
$response = file_get_contents($url);
// レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response, true);

// 取得結果をループさせてポケモンの名前を表示する
foreach($data['results'] as $key => $value){
    echo "<br>";
    $response_detail = file_get_contents($value['url']);
    $data_detail = json_decode($response_detail, true);
    echo "<img src={$data_detail['sprites']['front_default']} alt='ポケモン画像'"."<br>"; // デフォルト正面
    echo "<br>";
    echo $value['name']."<br>";  // 名前
    // var_dump($data['type']); // タイプ
    echo "たかさ：".$data_detail['height']." m<br>"; // たかさ
    echo "おもさ：".$data_detail['weight']." kg<br>"; // おもさ
    echo "<hr>";
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokemonAPI_Test</title>
</head>