<?php
session_start();
require_once "function.php";
login_checker();
$dbh = db_connect();

str_replace('!username!', '$_SESSION["login_name"]', "");

if(!empty($_POST["input"])) {

}

function show_id()
{
    global $dbh;
    $stmt = $dbh->prepare('SELECT id,name FROM products');
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$result["id"]}'>" . $result["name"] . "</option>";
    }
}

function show()
{
    # $sel_pageの初期値は1とする。
    if(!isset($_POST["sel_page"])) {
        $sel_page = 1;
    } else {
        $sel_page = $_POST["sel_page"];
    }
    global $dbh;

    # こっからページングの変数取得
    # SELECT COUNT(*) FROM products で列の長さを取得
    $length = $dbh->prepare('SELECT COUNT(*) FROM purchase
    INNER JOIN products ON products.id = purchase.product_id');
    $length->execute();

    $colum_length = $length->fetch(PDO::FETCH_ASSOC); # カラムの列の長さを取得
    $colum_length = $colum_length["COUNT(*)"]; # $colum_lengthに長さを代入

    $page = $colum_length / 20; # ページ数を取得
    $page = ceil($page); # 整数に直す。

    $now_page = ($sel_page - 1) * 20; # OFFSET を取得 ページ数 -1 * 20

    $stmt = $dbh->prepare('SELECT purchase.id,product_id,name,quantity,date,note FROM purchase
    INNER JOIN products ON products.id = purchase.product_id LIMIT 20 OFFSET :now_page');
    $stmt -> bindValue(':now_page', $now_page, PDO::PARAM_INT);
    $stmt->execute();

    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($result as $key => $value) {
                echo "<td>" . $value . "</td>";
            }
            /* 💭 ボタンにemoji をいれているのはいいですね！ */
            if(complete_mode($result["id"])) {
                echo "
                <form action='../function/update_purchase.php', method='get'>
                <td>
                <button type='submit' name='update_id' value={$result["id"]}>✍編集</button>
                </form>
                </td>";
                echo "
                <form action='../function/complete_purchase.php', method='post'>
                <td>
                <input type='hidden' name='key' value={$result["id"]} />
                <button type='submit' name='complete_id' value={$result["product_id"]}>✅完了</button>
                </form>
                </td>";
                echo "
                <form action='../function/delete_purchase.php', method='post'>
                <td>
                <button type='submit' name='delete_id' value={$result["id"]}>🚮削除</button>
                </form>
                </td>";
                echo "</tr>";
            } else {
                echo "
                <form action='../function/update_purchase.php', method='get'>
                <td>
                <button type='submit' name='update_id' value={$result["id"]} disabled>✍編集</button>
                </form>
                </td>";
                echo "
                <td>
                <button type='submit' name='complete_id' value={$result["product_id"]} disabled>完了済</button>
                </td>";
                echo "
                <form action='../function/delete_purchase.php', method='post'>
                <td>
                <button type='submit' name='delete_id' value={$result["id"]}>🚮削除</button>
                </form>
                </td>";
                echo "</tr>";
            }
    }
    # ページの数を取得し、表示
    echo "<p class='paging'>";
    for($i=1; $i<=$page; $i++) {
        echo "
        <form action='main_purchase.php' method='post'>
        <input type='hidden' name='sel_page' value='{$i}'>
        <input type='submit' class='page_btn' value='{$i}' class='paging'>
        </form>
        ";
    }
    echo "</p>";
}

//完了モード
function complete_mode($id)
{
    global $dbh;
    $stmt = $dbh->prepare('SELECT mode_id FROM mode');
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if($result["mode_id"]== $id) {
            $mode=false;
            break;
        } else {
            $mode=true;
        }
    }
    return $mode;
}

function product_search() //「検索」ボタン押下時
{global $dbh;
    if (isset($_POST["search"])) {
        if (isset($_POST["search_name"])) {    //「名前」だけ入力されている場合
            $search_name = $_POST["search_name"];
        }
        $sql = "SELECT purchase.id AS p_id,products.id,name,quantity,date,note FROM purchase LEFT JOIN products ON purchase.product_id = products.id WHERE products.name LIKE CONCAT('%', :data, '%') OR purchase.note LIKE CONCAT('%', :data, '%')";
        $stmt = $dbh->prepare($sql);
        $stmt -> bindParam(':data', $data);
        $data = $search_name;
        $search_stmt = $stmt->execute();
        echo "<tr>";
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($result as $key => $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
    } else {//「検索」ボタン押下してないとき
        $sql='SELECT * FROM products WHERE 1';
        $rec = $dbh->prepare($sql);
        $rec->execute();
        $rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>仕入れ情報一覧</title>
    <link rel='stylesheet' href='./CSS/main_product.css'>
</head>
<body>

<header>
	<h1>在庫管理アプリ</h1>
		<nav class="big_nav">
        <div class="user_login_now">
            <?php echo $_SESSION["user_name"]; ?>様
            <br>ログイン中
            <br>
            <?php
                if(!empty($_SESSION["login_text"])) {
                    echo $_SESSION["login_text"];
                    $_SESSION["login_text"] = "";
                }
?>
        </div>
            <ul class="nav">
				<form method="post" action="main_product.php">
					<li class="products_page">
						<input type="submit" class="products_page button" value="商品一覧">
					</li>
				</form>
				<form method="post" action="main_purchase.php">
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

        <div id="search_product">
            <!-- 検索画面 -->
            <sidebar class="sidebar" id="sidebar">
            <div class="searchbox">
            
			<h2>検索一覧</h2>
                <div class="searchbox" align="center">
						<form  method="post" action="main_purchase.php">
						<input type="text"  name="search_name" value="" placeholder="商品名" required>
						<input type="submit" class="button search_btn" name="search" value="検索" id="search">
						<!-- <label for="search"><i  class="fas fa-search"></i> </label> -->
						</form>
					</div>
                <table border="1" style="border-collapse: collapse"></div>
                <?php if (isset($_POST["search"])) {?>
                    <a href="main_purchase.php" id="release">検索を解除</a><br/>
                </table>
                <?php } ?><br>
			    <table border='1' align='center'>
				    <tr>
					    <th>ID</th>
					    <th>商品ID</th>
					    <th>商品名</th>
					    <th>仕入数</th>
					    <th>日付</th>
					    <th>備考</th>
				    </tr>
				    <?php product_search(); ?>
            </table>
            </div>

            <div id="reg_product">
            <h2>仕入れ情報登録</h2>
            <form action="../function/add_purchase.php" method="post">
            <table border="1" align='center'>
                <tr>
                <th>商品名</th>
                    <td>
                    <select name="product_id">
                        <option value="-">-</option>
                        <?php
            show_id();
?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th>仕入れする個数</th>
                    <td><input type="text" name="stock" min="0" value="0">個</td>
                </tr>
                <tr>
                    <th>日付</th>
                    <td><input type="date" name="date" ></td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td><textarea name="note" row="4" cols="22"></textarea></td>
                </tr>
            </table>
		    <div id="button2" align="center">
                <p>
                    <button type="submit" name="submit" class="button add_btn">追加する</button>
                </p>
            </div>
            </form>
            <div align="center">
                <?php
                    if(!empty($_SESSION["add_text"])) {
                        echo $_SESSION["add_text"];
                        $_SESSION["add_text"] = "";
                    }
                ?>
            </div>
            </div>
            </sidebar>

</header>

<main>
    <div class="product">

    </div>
    <div id="list_product">
        <h2>仕入れ情報一覧</h2><br>
        <?php
        if(!empty($_SESSION["delete_text"])) {
            echo $_SESSION["delete_text"];
            $_SESSION["delete_text"] = "";
        }
?>
            <table border="1">
	        <tr>
                <th>ID</th>
                <th>商品ID</th>
                <th>商品名</th>
                <th>仕入数</th>
                <th>日付</th>
                <th>備考</th>
            </tr>
	        <?php show(); ?>
            </table>

        <div align="center">
            <div class="file_out">
                <form action="../function/input_purchase.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="input" >
                        <input type="submit" class="button csv_btn" value="入力する">
                </form>
            </div>
                <form action='../function/confirm_purchase.php' method='post'>
                    <p>
                    <button class="button export_btn" type='submit' name='export'>CSVを出力する</button>
                    </p>
                </form>
        </div>
        </div>
</main>
</body>
</html>


