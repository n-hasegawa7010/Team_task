<?php
function show(){
    // $sel_page = $_POST["sel_page"];
    if(!isset($_POST["sel_page"])){
        $sel_page = 1;
    }else{
        $sel_page = $_POST["sel_page"];
    }
    echo "sel_page：".$sel_page."<br>";
    $dsn = 'mysql:host=localhost; dbname=team3; charset=utf8';
    $user = 'team3';
    $pass = 'team3';
    try {
        $dbh = new PDO($dsn, $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		# SELECT COUNT(*) FROM products で列の長さを取得
		$length = $dbh->prepare('SELECT COUNT(*) FROM products');
		$length->execute();
		# カラムの列の長さを取得
		$colum_length = $length->fetch(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($colum_length);
        // echo "</pre>";
        $colum_length = $colum_length["COUNT(*)"];
        echo "列数取得：".$colum_length."<br>";
        echo "1ページに表示する最大カラム数：20<br>";
        
        $page = $colum_length / 20;
        // $colum_onpage = $colum_length % 20;
        // echo "1ページに表示するカラム数：".$colum_onpage."<br>";
        $page = ceil($page);
        echo "ページ数：".$page."<br>";
        $now_page = ($sel_page - 1) * 20;

        $stmt = $dbh->prepare("SELECT * FROM products LIMIT 20 OFFSET :now_page");
        // OFFSETにパラメータを渡すときに、どうしても文字列扱いを受けてしまうので、
        // PDO::PARAM_INT で明示的に数値を渡すように指定しています。←ありがとうございます！
        // ページ数 -1 * 20
        $stmt -> bindValue(':now_page', $now_page, PDO::PARAM_INT);
        $stmt->execute();

    } catch (PDOException $e) {
        echo "エラー内容：" . $e->getMessage();
        die();
    }
echo "<table border='1'>";
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
		# ページングするため、LIMIT 20 OFFSET i*10
        foreach ($result as $key => $value) {
            echo "<td>" . $value . "</td>";
        }
		echo "
		<form action='../function/update_product.php', method='post'>
		<td>
        <button type='submit' name='update_id' value={$result["id"]}>✍編集</button>
        </form>
		</td>";
		echo "
		<form action='../function/delete_product.php', method='post'>
		<td>
        <button type='submit' name='delete_id' value={$result["id"]}>🚮削除</button>
        </form>
		</td>";
        echo "</tr>";
    }
    echo "</table>";

    # ページの数を取得し、表示
    echo "<p>";
    for($i=1; $i<=$page; $i++){
        echo "
        <form action='Naoto_test.php' method='post'>
        <input type='hidden' name='sel_page' value='{$i}'>
        <input type='submit' value='{$i}'>
        </form>
        ";
    }
    echo "</p>";
    
    /*
    for(i=0; i<=$page; i++){
    $stmt = $dbh->prepare("SELECT * FROM products LIMIT 5")
    }
    */
}


# show()の実行
show();



?>