<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pokemonAPI.css">
    <title>PokemonAPI_Test</title>
</head>

<body>

<header>
    <h1>ポケモン図鑑</h1>
</header>
<?php

// 取得結果をループさせてポケモンの名前を表示する
function view_poke(){
    /** PokeAPI のデータを取得する(id=1から10のポケモンのデータ) */
    $url = 'https://pokeapi.co/api/v2/pokemon/?limit=5&offset=0';
    $response = file_get_contents($url);
    // レスポンスデータは JSON 形式なので、デコードして連想配列にする
    $data = json_decode($response, true);

    
    foreach($data['results'] as $key => $value){
        $response_detail = file_get_contents($value['url']);
        $data_detail = json_decode($response_detail, true);

        echo '<div class = "poke_data">';
            echo "<br>";
            echo '<div class = "poke_img">';
                echo "<img src={$data_detail['sprites']['front_default']} alt='ポケモン画像'"."<br>"; // デフォルト正面
                echo "<br>";
            echo '</div>';

            echo '<div class = "poke_ex">';
                // 名前
                echo $value['name']."<br>";
                
                // var_dump($data['type']); // タイプ
                
                // たかさ
                echo "たかさ：".$data_detail['height']." m<br>";
                
                // おもさ
                echo "おもさ：".$data_detail['weight']." kg<br>";
            echo '</div>';
        echo '</div>';
    }
}
view_poke();
?>

</body>

<footer>

</footer>

</html>