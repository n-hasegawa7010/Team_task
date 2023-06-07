<?php
 session_start();
 require_once "../index/function.php";
login_checker();
$dbh = db_connect();
export_product();

function export_product(){
    var_dump($_FILES["input"]);
    $file = $_FILES["input"];
    $filename = htmlentities($file["tmp_name"], ENT_QUOTES, "utf-8");
    //$file = "../CSV/product_1684221011.csv"; 

    if($filename == ""){
        $text = "CSVファイルが選択されていません";
        $_SESSION["delete_text"] = $text;
        header('Location: ../index/main_product.php');
        die();
    }

    global $dbh;
    try {
        $f = fopen($filename, "r");
        while($line = fgetcsv($f)) {
            for ($i=0;$i<count($line);$i++) {
                if($i==0){
                    $name = $line[$i];
                }
                if($i==1){
                    $stock = $line[$i];
                }
                if($i==2){
                    $price = $line[$i];
                }
            }
            $stmt = $dbh->prepare('INSERT INTO products(name, stock, price) VALUES (:name,:stock,:price)');
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':price', $price);
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
    header('Location: ../index/main_product.php');
}

?>
