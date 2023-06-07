<?php

#-----------------------------------------------------------
# 基本設定
#-----------------------------------------------------------

#データベース情報
$testuser ="testuser";
$testpass ="testpass";
$host ="localhost";
$datebase ="booksample";

# テンプレートディレクトリを保存
$tmpl_dir = "./tmpl";

#-----------------------------------------------------------
# ページの表示
#-----------------------------------------------------------
parse_form();
try {
	$db = new PDO("mysql:host={$host}; dbname=$datebase; charset=utf8", $testuser, $testpass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if ($in["mode"] == "search") { search_data(); }
}catch (PDOException $e) {
	die ("PDO Error:" . $e->getMessage());
}

#-----------------------------------------------------------
# フォーム受け取り
#-----------------------------------------------------------
function parse_form(){
	global $in;

	$param = array();
	if (isset($_GET) && is_array($_GET)) { $param += $_GET; }
	if (isset($_POST) && is_array($_POST)) { $param += $_POST; }
	
	foreach($param as $key => $val) {
		# 2次元配列から値を取り出す
		if(is_array($val)){
			$val = array_shift($val);
		}
		
		# 文字コードの処理
		$enc = mb_detect_encoding($val);
		$val = mb_convert_encoding($val,"UTF-8",$enc);
		
		# 特殊文字の処理
		$val = htmlentities($val,ENT_QUOTES, "UTF-8");
		$in[$key] = $val;
	}
	return $in;
}

#-----------------------------------------------------------
# 検索
#-----------------------------------------------------------
function search_data(){
	global $in;
	global $db;
	global $tmpl_dir;

	# SQLを作成(検索条件をSQLに埋め込む)
	$search_criteria_tmp = array(); // 検索条件を入れる配列

	/*
	"user_id = :user_id",
	"name = :name",
	"tel = :tel",
	...,
	*/

	// 空情報じゃなければ以下を実行
	if(!empty($in["user_id"])){ // user_idがフォームから送られてきているとき
		array_push($search_criteria_tmp , "user_id = :user_id"); // SELECT * FROM user WHERE user_id = :user_id;
	}
	if(!empty($in["name"])){
		array_push($search_criteria_tmp , "name = :name"); // SELECT * FROM user WHERE name = :name;
	}
	if(!empty($in["tel"])){
		array_push($search_criteria_tmp , "tel = :tel");
	}
	if(!empty($in["email"])){
		array_push($search_criteria_tmp , "email = :email");
	}
	if(!empty($in["course"])){
		array_push($search_criteria_tmp , "course = :course");
	}
	$query = "SELECT * FROM user"; // SELECT * FROM user

	// implode("区切り文字",配列) => 配列を区切り文字でつなげて文字列を作る
	// -> "user_id = :user_id AND name = name:name AND tel = :tel AND ..."
	/*完成イメージ：
		SELECT * FROM user
		WHERE
			user_id = :user_id
		AND
			name = :name
		AND
			tel = :tel
		AND
			email = :email
		AND
			course = :course
	*/

	// 検索条件が1つ以上あるとき。
	if(count($search_criteria_tmp)>=1){
		$search_criteria = implode(" AND ", $search_criteria_tmp);
		$query .= " WHERE " . $search_criteria;
	}

	// 検索条件が入力されていないときにやると
	// SELECT * FROM user
	// となってしまう。

	# プリペアードステートメントを準備する
	$stmt = $db->prepare($query);
	if(!empty($in["user_id"])){
		$stmt->bindParam(':user_id', $user_id);
		$user_id = $in["user_id"];
	}
	if(!empty($in["name"])){
		$stmt->bindParam(':name', $name);
		$name = $in["name"];
	}
	if(!empty($in["tel"])){
		$stmt->bindParam(':tel', $tel);
		$email = $in["tel"];
	}
	if(!empty($in["email"])){
		$stmt->bindParam(':email', $email);
		$email = $in["email"];
	}
	if(!empty($in["course"])){
		$stmt->bindParam(':course', $course);
		$course = $in["course"];
	}
	$stmt->execute(); // SELECTを実行したstmtは、実行結果を持っている(条件に一致したレコードの情報)

	# テンプレート読み込み
	$conf = fopen("$tmpl_dir/data.tmpl","r") or die;
	$size = filesize("$tmpl_dir/data.tmpl");
	$tmpl = fread($conf , $size);
	fclose($conf);

	# 画面の構築
	$user_data = "";	
	while($row = $stmt->fetch()){ // 実行結果を1行ずつ取り出す、1回目の時は1つ目のデータ、2回目の時は2つ目のデータ...
		$tmple = $tmpl;
		$tmple = str_replace("!user_id!",$row["user_id"],$tmple);
		$tmple = str_replace("!name!",$row["name"],$tmple);
		$tmple = str_replace("!tel!",$row["tel"],$tmple);
		$tmple = str_replace("!email!",$row["email"],$tmple);
		$tmple = str_replace("!course!",$row["course"],$tmple);
		$user_data .= $tmple;
	}

	# 掲示板テンプレート読み込み
	$conf = fopen("$tmpl_dir/search.tmpl","r") or die;
	$size =	filesize("$tmpl_dir/search.tmpl");
	$tmpl = fread($conf, $size);
	fclose($conf);

	# 文字変換
	$tmpl = str_replace("!user_data!",$user_data,$tmpl);
	echo $tmpl;
	exit;
}

#-----------------------------------------------------------
# エラー画面
#-----------------------------------------------------------
function error($errmes){
	global $tmpl_dir;
	$msg = $errmes;

	# テンプレート読み込み
	$conf = fopen("$tmpl_dir/error.tmpl","r") or die;
	$size = filesize("$tmpl_dir/error.tmpl");
	$tmpl = fread($conf,$size);
	fclose($conf);

	# 文字置き換え
	$tmpl = str_replace("!message!","$msg",$tmpl);
	echo $tmpl;
	exit;
}