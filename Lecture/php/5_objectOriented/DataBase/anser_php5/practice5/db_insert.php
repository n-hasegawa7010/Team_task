<?php

#-----------------------------------------------------------
# 基本設定
#-----------------------------------------------------------

#データベース情報
$testuser ="testuser";
$testpass ="testpass";
$host ="localhost";
$datebase ="booksample";

# テンプレートディレクトリ
$tmpl_dir = "./tmpl";

#-----------------------------------------------------------
# ページの表示 (メインの実行部分)
#-----------------------------------------------------------
parse_form(); // $in にフォームの情報をまとめる。
try {
	$db = new PDO("mysql:host={$host}; dbname=$datebase; charset=utf8", $testuser, $testpass);

	// try-catchでエラー処理を行えるように設定
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// データの追加を実行
	// formから、<input name = "mode" value = "post">の項目が送られてこなければ、post_data()は実行されない。
	if ($in["mode"] == "post") { post_data(); }
	
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
# 記事書き込み
#-----------------------------------------------------------
function post_data(){
	global $in;
	global $db;
	global $tmpl_dir;

	# 名前またはコメント未入力はエラー
	if(!isset($in["name"]) || !isset($in["tel"]) || !isset($in["email"]) || !isset($in["course"])) {
		error('未入力項目があります。');
	}
	// 未入力項目はなく、全部送信されてきた。
	
	if(!preg_match('/\d{2,4}-\d{3,4}-\d{3,4}/',$in["tel"])){
		error("電話番号が不正です。");
	}

	if(!preg_match('/\w+@\w+/',$in["email"])){
		error("メールアドレスが不正です。");
	}
	// 入力項目は全て正しいと判断できる。

	# プリペアードステートメントを準備する
	$stmt = $db->prepare('INSERT INTO user (name, tel, email, course) VALUES (:name, :tel, :email, :course)');

	# 変数を束縛する
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':tel', $tel);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':course', $course);

	# 変数に値を設定し、SQLを実行
	$name = $in["name"];
	$tel = $in["tel"];
	$email = $in["email"];
	$course = $in["course"];

	// エラーがある場合はエラー画面を表示
	if(!is_string($name)){ error("名前を正しく指定してください。"); }
	if(!is_string($tel)){ error("電話番号を正しく指定してください。"); }
	if(!is_string($email)){ error("メールアドレスを正しく指定してください。"); }
	if(!is_string($course)){ error("コースを正しく指定してください。"); }
	
	// error()の中で、exitという関数を実行しているので、プログラムは終了する。

	// 以降は、エラーがなく、データベースに内容を送信 -> 完了画面を表示する処理
	$stmt->execute();

	# テンプレート読み込み
	$conf = fopen("$tmpl_dir/send.tmpl","r") or die;
	$size = filesize("$tmpl_dir/send.tmpl");
	$data = fread($conf , $size);
	// send.tmplを読み込んで、$dataに読み込む。
	fclose($conf);

	# 文字置き換え
	$data = str_replace("!top!", "./db_form.html", $data);
	// send.tmplの中から!top!を探し、./db_form.htmlに置き換え。
	echo $data;
	// $dataの中身 = send.tmplが表示される。
	exit;
}

// include_onceなどを使うことで、短くプログラムを書くことができる。
// 一つの関数内で20行以上は長いと言われている。簡潔にコードを書けるようにする。

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
