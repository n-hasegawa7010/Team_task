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
    if(!isset($_POST["sel_page"])) {
        $sel_page = 1;
    } else {
        $sel_page = $_POST["sel_page"];
    }

    $limit = 50; // 表示するポケモンの最大数
    $one_page = 21; // 1ページに表示するポケモンの数
    $page = $limit / $one_page; # ページ数を取得
    $page = ceil($page); # 整数に直す。
    $now_page = ($sel_page - 1) * $one_page; # OFFSET を取得 ページ数 -1 * 20

    echo "<div class='paging'>";
    for($i=1; $i<=$page; $i++) {
        echo "
        <form action='pokemonAPI.php' method='post'>
            <input type='hidden' name='sel_page' value='{$i}'>
            <input type='submit' class='page_btn' value='{$i}' class='paging'>
        </form>
        ";
    }
    echo "</div>";

    /** PokeAPI のデータを取得する(id=1から10のポケモンのデータ) */
    $url = "https://pokeapi.co/api/v2/pokemon/?limit={$one_page}&offset={$now_page}";
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

            echo '<div class = "button">';
                echo '<p class = "btnA"></p>';
                echo '<p class = "btnB"></p>';
            echo '</div>';

            echo '<div class = "line">';
                echo '<p class="lineA"></p>';
                echo '<p class="lineB"></p>';
                echo '<p class="lineC"></p>';
            echo '</div>';

            // echo '<div class = "ab">';
            //     echo '<p class="A">A</p>';
            //     echo '<p class="B">B</p>';
            // echo '</div>';

            echo '<div class = "poke_ex">';
                // 名前
                echo "<p>".$value['name']."</p>";
                
                // var_dump($data['type']); // タイプ
                // echo "<p>".$data_detail['types']['name']."</p>";

                // たかさ
                echo "<p>たかさ：".$data_detail['height']." m</p>";
                
                // おもさ
                echo "<p>おもさ：".$data_detail['weight']." kg</p>";
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