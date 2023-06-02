<?php
 session_start();
 require_once "../index/function.php";
// login_checker();
$dbh = db_connect();
export_purchase();

function export_purchase(){
    var_dump($_FILES["input"]);
    /*  ファイル選択せずに送信した場合の対応も入れておくとよさそうです */
    $file = $_FILES["input"];
    $filename = htmlentities($file["tmp_name"], ENT_QUOTES, "utf-8");
    //$file = "../CSV/product_1684221011.csv"; 

    if($filename == ""){
        $text = "CSVファイルが選択されていません";
        $_SESSION["delete_text"] = $text;
        header('Location: ../index/main_purchase.php');
        die();
    }
    global $dbh;
    try {
        $f = fopen($filename, "r");
        while($line = fgetcsv($f)) {
            for ($i=0;$i<count($line);$i++) {
                if($i==0){
                    $product_id = $line[$i];
                }
                if($i==1){
                    $stock = $line[$i];
                }
                if($i==2){
                    $date = $line[$i];
                }
                if($i==3){
                    $note = $line[$i];
                }
            }
            $stmt = $dbh->prepare('INSERT INTO purchase(product_id,quantity, date, note) VALUES (:product_id,:stock,:date,:note)');
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':note', $note);
            $stmt->execute();
        }
    } catch (Exception $e) {
        $text = "CSVファイルの入力に失敗しました";
        header('Location: ../index/main_product.php');
        die();
    }


    $text = "CSVファイルの入力に成功しました";
    $_SESSION["delete_text"] = $text;
    //$dbh = null;
    header('Location: ../index/main_purchase.php');
}

?>
