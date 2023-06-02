<?php
class Profile {
  public $name;
  public $tel;
  public $email;
  public function show() {
    echo "{$this->name} さんの電話番号は{$this->tel}、メールアドレスは{$this->email}です。<br>";
  }
}

//$tanaka オブジェクト
$tanaka = new Profile();
$tanaka->name = " 田中";
$tanaka->tel = "123-3456-7890";
$tanaka->email = "taro@aaa.com";
$tanaka->show();

//$yamada オブジェクト
$yamada = new Profile();
$yamada->name = " 山田";
$yamada->tel = "123-3456-7890";
$yamada->email = "yamada@aaa.com";
$yamada->show();

