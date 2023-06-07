<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
    <form method="post" action="./get_inputs.php">
        <table border="1" cellpadding="4" cellspacing="0">
            <tr>
                <th> お名前</th>
                <td><input name="name" type="text" size="40"></td>
                </tr>
            <tr>
                <th> お問い合わせ種別</th>
                <td>
                <input name="category[]" type="checkbox" value="content"> 商品
                <input name="category[]" type="checkbox" value="service"> サービス
                <input name="category[]" type="checkbox" value="recruite"> 採用
                <input name="category[]" type="checkbox" value="other"> その他
                </td>
            </tr>
            <tr>
                <th> 性別</th>
                <td>
                <input name="gender" type="radio" id="man" value="man"> 男性
                <input name="gender" type="radio" id="woman" value="woman"> 女性
                </td>
            </tr>
            <tr>
                <th colspan="2">
                <input type="submit" name="submit" value=" 送信">
                </th>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
if(array_key_exists('submit', $_POST)){
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    foreach ($_POST as $key => $value) {
        // POSTの中に入っているデータが配列だったら、文字列形式に直してから、処理する。
        if(is_array($value)){
            $value = implode(', ',$value);
        }
        $value = htmlentities($value,ENT_QUOTES,'utf-8');
        echo "<p>$value</p>";
    }
}
