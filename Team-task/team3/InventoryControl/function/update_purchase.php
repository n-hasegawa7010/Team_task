<?php
    session_start();
    require_once "../index/function.php";
    login_checker();
    $dbh = db_connect();

    $stmt = $dbh->prepare('SELECT quantity,date,note,name FROM purchase INNER JOIN products ON purchase.product_id = products.id WHERE purchase.id = ?');
    $data = Array($_GET["update_id"]);
    $stmt_result = $stmt->execute($data);
    $fetch = $stmt->fetch();

    if(! empty($_POST)){ //POSTに値が入っている（編集完了ボタンが押された）らここがうごく
        $stmt = $dbh->prepare("UPDATE purchase SET quantity = ?, date = ?, note = ? WHERE id = ?");
        $quantity = htmlentities($_POST["quantity"], ENT_QUOTES, "utf-8");
        $date = htmlentities($_POST["date"], ENT_QUOTES, "utf-8");
        $note = htmlentities($_POST["note"], ENT_QUOTES, "utf-8");
        if($quantity==null){
            $_SESSION['update_text'] = "空白のデータがあります。";
            header('Location: update_purchase.php?update_id='.$_GET["update_id"]);
            die;
        }
        else if(is_numeric($quantity)==false){
            $_SESSION['update_text'] = "値段に数字ではないデータが入力されました";
            header('Location: update_purchase.php?update_id='.$_GET["update_id"]);
            die;
        }
        $data = Array($_POST["quantity"], $_POST["date"], $_POST["note"], $_GET["update_id"]);
        $stmt_result = $stmt->execute($data);
        if($stmt->rowCount() > 0){
            $_SESSION['delete_text'] = "リストを更新しました";
            header('Location: ../index/main_purchase.php');
            exit;
        }else {
            $_SESSION['update_text'] = "更新に失敗しました";
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>編集画面</title>
    <link rel='stylesheet' href='../index/CSS/main_product.css'>
</head>
<body>
    <header>
        <h1>仕入れ情報の変更</h1>
        <nav class="big_nav">
            <div class="user_login_now">
                <?php echo $_SESSION["user_name"]; ?>様<br>ログイン中
            </div>
            <ul class="nav">
				<form method="post" action="../index/main_product.php">
					<li class="products_page">
						<input type="submit" class="products_page button" value="商品一覧">
					</li>
				</form>
				<form method="post" action="../index/main_purchase.php">
					<li class="purchase_page">
						<input type="submit" class="purchase_page button" value="仕入れ情報一覧">
					</li>
				</form>
				<form method="post" action="../logout/logout.php">
					<li class="logout_page">
						<input type="submit" class="logout_page button" value="ログアウト">
					</li>
				</form>
			</ul>
        </nav>
    </header>

    <div id="session">

    </div>
    <br>
    <form action="", method="post">
    <table border='1' align="center" class="ud_table">
        <tr>
            <th>商品名</th>
            <td><?php echo $fetch["name"] ?></td>
        </tr>
        <tr>
            <th>仕入れ数</th>
            <td><input type="int" name="quantity" min="0" value="<?php echo $fetch["quantity"] ?>"></td>
        </tr>
        <tr>
            <th>日付</th>
            <td><input type="date" name="date" value="<?php echo $fetch["date"] ?>"></td>
        </tr>
        <tr>
            <th>備考</th>
            <td><input type="text" name="note" value="<?php echo $fetch["note"] ?>"></td>
        </tr>
    </table>
    <div id="button1-1" align="left">
        <p align="center">
            <button type="submit" class="button add_btn" name="submit">編集する</button>
        </p>
    </div>
    </form>
    <div align="center">
    <?php
        if(!empty($_SESSION)){
    		echo $_SESSION["update_text"];
	    	$_SESSION["update_text"] = "";
        }
    ?>
    </div>
    </body>
</html>
