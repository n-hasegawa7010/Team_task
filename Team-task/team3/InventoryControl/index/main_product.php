<?php

session_start();
require_once "function.php";
login_checker();
$dbh = db_connect();

# ページング処理
function show(){
	# $sel_pageの初期値は1とする。
    if(!isset($_POST["sel_page"])){
        $sel_page = 1;
    }else{
        $sel_page = $_POST["sel_page"];
    }
	global $dbh;
	# SELECT COUNT(*) FROM products で列の長さを取得
	$length = $dbh->prepare('SELECT COUNT(*) FROM products');
	$length->execute();

	$colum_length = $length->fetch(PDO::FETCH_ASSOC); 	# カラムの列の長さを取得
	$colum_length = $colum_length["COUNT(*)"]; 	# $colum_lengthに長さを代入
    $page = $colum_length / 20; # ページ数を取得
	$page = ceil($page); # 整数に直す。

	$now_page = ($sel_page - 1) * 20; # OFFSET を取得 ページ数 -1 * 20

	$stmt = $dbh->prepare("SELECT * FROM products LIMIT 20 OFFSET :now_page");
	// OFFSETにパラメータを渡すときに、どうしても文字列扱いを受けてしまうので、
	// PDO::PARAM_INT で明示的に数値を渡すように指定しています。←ありがとうございます！
	$stmt -> bindValue(':now_page', $now_page, PDO::PARAM_INT);
	$stmt->execute();

    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
		# ページングするため、LIMIT 20 OFFSET i*10
        foreach ($result as $key => $value) {
            echo "<td>" . $value . "</td>";
        }
		echo "
		<form action='../function/update_product.php', method='get'>
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

    # ページの数を取得し、表示
    echo "<p class='paging'>";
    for($i=1; $i<=$page; $i++){
        echo "
        <form action='main_product.php' method='post'>
        <input type='hidden' name='sel_page' value='{$i}'>
        <input type='submit' class='page_btn' value='{$i}' class='paging'>
        </form>
        ";
    }
    echo "</p>";
}


function product_search(){ //「検索」ボタン押下時
	global $dbh;
    if (isset($_POST["search"])) {
    	//「名前」だけ入力されている場合
     	if (isset($_POST["search_name"])){
        	$search_name = $_POST["search_name"];
    		$sql="SELECT * FROM products WHERE name LIKE CONCAT('%',:data,'%')";
			$stmt = $dbh->prepare($sql);
			$stmt -> bindParam(':data',$data);
			$data = $search_name;
			$search_stmt = $stmt->execute();
while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    foreach ($result as $key => $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
}
		}
    }
    else{//「検索」ボタン押下してないとき
        $sql='SELECT * FROM products WHERE 1';
        $rec = $dbh->prepare($sql);
        $rec->execute();
        $rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>

<!DOCTYPE html>
<html lang='ja'>

<head>
	<meta charset='UTF-8'>
	<title>在庫管理</title>
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
				if(! empty($_SESSION["login_text"])){
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
		<!--MySQLデータを表示-->
		<div id="search_product">
			<!-- 検索画面 -->
			<sidebar class="sidebar" id="sidebar">
				<div class="searchbox">
					<h2>検索一覧</h2>
					<div class="searchbox" align='center'>
						<form method="post" action="main_product.php">
							<input type="text" name="search_name" value="" placeholder="商品名" required>
							<input type="submit" class="button search_btn" name="search" value="検索" id="search">
						</form>
					</div>
					<!--検索解除-->
					<table border="1" style="border-collapse: collapse">
						<?php if (isset($_POST["search"])) {?>
						<a href="main_product.php" id="release">検索を解除</a><br />
					</table>
					<?php } ?><br>
					<table border='1' align='center'>
						<tr>
							<th>商品ID</th>
							<th>商品名</th>
							<th>在庫</th>
							<th>値段</th>
						</tr>
						<?php product_search(); ?>
					</table>
				</div>

				<div id="reg_product">
					<h2>商品登録</h2>
					<!-- 追加画面 -->
					<form action='../function/add_product.php' method='post'>
						<br>
						<table border='1' align='center'>
							<tr>
								<th>商品名</th>
								<td><input name='product_name' type='text' value=''></td>
							</tr>
							<tr>
								<th>値段</th>
								<td><input type='text' name='price' min='0' value='0'>円</td>
							</tr>
						</table>
						<div align="center">
							<p>
								<button type='submit' class="button add_btn" name='submit'>登録する</button>
							</p>
						</div>
					</form>
					<div align="center">
						<?php
				if(! empty($_SESSION["add_text"])){
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
			<div id="session">
			</div>
			<div id="list_product">
				<h2>商品一覧</h2><br>
				<?php
			if(! empty($_SESSION)){
				echo $_SESSION["delete_text"];
				$_SESSION["delete_text"] = "";
			}
			?>
				<table border='1'>
					<tr>
						<th>商品ID</th>
						<th>商品名</th>
						<th>在庫</th>
						<th>値段</th>
						<th colspan=2></th>
					</tr>
					<?php show(); ?>
				</table>
				<div align="center">
					<div class="file_out">
						<form action="../function/input_product.php" method="post" enctype="multipart/form-data">
							<input type="file" name="input" class="file">
							<input type="submit" class="button csv_btn" value="入力する">
						</form>
					</div>
					<div>
						<form action='../function/confirm_product.php' method='post'>
							<button type='submit' class="button export_btn" name='export'>CSVを出力する</button>
						</form>
					</div>
				</div>
			</div>
	</main>
</body>

</html>
