 <?php
    session_start();
    require_once "../index/function.php";
    login_checker();
    $dbh = db_connect();

    $stmt = $dbh->prepare('SELECT * FROM products WHERE id=?');
    $data = Array($_GET["update_id"]);
    $stmt_result = $stmt->execute($data);
    $fetch = $stmt->fetch();

    if(! empty($_POST)){ //POSTに値が入っている（編集完了ボタンが押された）らここがうごく
        $stmt = $dbh->prepare("UPDATE products SET name = ?, price = ? WHERE id = ?");
        $name = htmlentities($_POST["product_name"], ENT_QUOTES, "utf-8");
        $price = htmlentities($_POST["price"], ENT_QUOTES, "utf-8");
        if(empty($name)==true||$price==null){
            $_SESSION['update_text'] = "空白のデータがあります";
            header('Location: update_product.php?update_id='.$_GET["update_id"]);
            die;
        }
        else if(is_numeric($price)==false){
            $_SESSION['update_text'] = "値段に数字ではないデータが入力されました";
            header('Location: update_product.php?update_id='.$_GET["update_id"]);
            die;
        }
        $data = Array($_POST["product_name"], $_POST["price"],$_GET["update_id"]);
        $stmt_result = $stmt->execute($data);
        if($stmt->rowCount() > 0){
            $_SESSION['delete_text'] = "リストを更新しました";
            header('Location: ../index/main_product.php');
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
        <h1>商品情報の変更</h1>
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


    <br>
    <form action="" , method="post">
        <table border='1' align="center" class="ud_table">
            <tr>
                <th>商品名</th>
                <td><input name="product_name" type="text" value="<?php echo $fetch["name"] ?>"></td>
            </tr>
            <tr>
                <th>値段</th>
                <td><input type="text" name="price" min="0" value="<?php echo $fetch["price"] ?>">円</td>
            </tr>
        </table>
        <div id="button1-1" align="center">
            <p align="center">
                <button type="submit" class="button add_btn" name="submit">編集する</button>
            </p>
        </div>
    </form>
    <div align="center">
    <?php
        /* 💭 $_SESSION["update_text"] を空チェックしたほうがよいかもしれません */
        if(!empty($_SESSION["update_text"])){
            echo $_SESSION["update_text"];
            $_SESSION["update_text"] = "";
        }
    ?>
    </div>
    <br>
    </body>

    </html>
