<html lang="ja">
    
</html>

<?php
try {
    $ans = div(10, 2);
    echo "除算結果：".$ans;
} catch (Exception $e) {
    // throwされた例外をcatchする
    echo " エラー:" . $e->getMessage();
}
function div($val1, $val2) {
    // val2が0。0で割ってしまった場合
    if ($val2 == 0){
        // 例外を投げる(throw)する。
        throw new Exception(" ゼロを除算");
    }
    $ans = $val1 / $val2;
    return $ans;
}
