<?php
$mailto = "dezenyona@fanclub.pm";
$toppage = "./form.hmtl";

// 情報受け取り
$name = $_POST["name"];
$email = $_POST["email"];
$comment = $_POST["comment"];

// 無効化
$name = htmlentities($name,ENT_QUOTES,"UTF-8");
$comment = htmlentities($comment,ENT_QUOTES,"UTF-8");
$email = htmlentities($email,ENT_QUOTES,"UTF-8");

// 改行処理
$name = str_replace("\r\n","",$name); // 名前の中に改行があったら、削除
$email = str_replace("\r\n","",$email); // メールアドレスの中に改行があったら削除
$comment = str_replace("\r\n","\t",$comment); // 改行があったらタブキーに変換
$comment = str_replace("\r","\t",$comment);
$comment = str_replace("\n","\t",$comment);

if($name == ""){
  error("お名前が未入力です");
}
if (!preg_match("/\w+@\w+/",$email)){
  error(" メールアドレスが不正です");
}
if($comment == ""){
  error("お問い合わせ内容が未入力です");
}

# 分岐チェック
if ($_POST["mode"] == "post") { conf_form(); }
else if($_POST["mode"] == "send") { send_form(); }

function conf_form(){
  # グローバル変数の$nameなどを用いるため、global宣言を行う。
  global $name;
  global $email;
  global $comment;

  # テンプレート読み込み
  # 一番上にある$nameなどを使うため。
  $conf = fopen("tmpl/conf.tmpl","r") or die;
  $size = filesize("tmpl/conf.tmpl");
  $data = fread($conf , $size);
  fclose($conf);

  # 文字置き換え
  $data = str_replace("!name!", $name, $data); // !name!の意味は後で変数に置き換える予定という意味。
  $data = str_replace("!email!", $email, $data);
  $data = str_replace("!comment!", $comment, $data);

  # 表示
  echo $data;
  exit;
}

# エラー画面
function error($msg){
  $error = fopen("tmpl/error.tmpl","r");
  $size = filesize("tmpl/error.tmpl");
  $data = fread($error,$size);
  fclose($error);

  # 文字置き換え
  $data = str_replace("!message!",$msg,$data);

  echo $data;
  exit;
}

function send_form(){
  global $name;
  global $email;
  global $comment;

  $user_input = array($name,$email,$comment);
  mb_convert_variables("SJIS","UTF-8",$user_input);
  $fh = fopen("user.csv","a");
  flock($fh,LOCK_EX);
  fputcsv($fh,$user_input);
  flock($fh,LOCK_UN);
  fclose($fh);

  # メール送信
  send_mail();

  $conf = fopen("tmpl/send.tmpl","r");
  $size = filesize("tmpl/send.tmpl");
  $data = fread($conf,$size);
  fclose($conf);

  global $toppage;
  $data = str_replace("!top!",$toppage,$data);

  echo $data;
  exit;
}

#-----------------------------------------------------------
# メール送信
#-----------------------------------------------------------
function send_mail(){
  # 時間とIP アドレスの取得
  $date = date("Y/m/d H:i:s");
  $ip = getenv("REMOTE_ADDR");

  global $name;
  global $email;
  global $comment;

  # 本文
  $body = <<< _FORM_
  フォームメールより、次のとおり連絡がありました。

  日時 ： $date
  IP情報 ： $ip
  名前 ： $name
  メールアドレス ： $email
  コメント ： $comment
_FORM_;

  # 送信
  global $mailto;
  mb_language("japanese");
  mb_internal_encoding("UTF-8");
  $name_sendonly = "送信専用アドレス";
  $name_sendonly = mb_encode_mimeheader($name_sendonly);
  $mail_sendonly = "ooo@internetacademy.co.jp";
  $mailfrom = "From:".$name_sendonly."<".$mail_sendonly.">";
  $subject = "フォームから連絡がありました";
  mb_send_mail($mailto,$subject,$body,$mailfrom);
  // mb_send_mail(送り先のメールアドレス,題名,内容,自分のメールアドレス);　
}