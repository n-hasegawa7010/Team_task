<?php

// require_once：指定したプログラムを読み込んで実行する。
require_once("Dog.php");
require_once("Pochi.php");

// インスタンスの生成：dog オブジェクトをプログラムの中に作る
$dog = new Dog('ラブラドール'); // 同じ犬でも名前をつけて管理することができる。
$dog2 = new Dog('チワワ');

$pochi = new Pochi();

$dog->bow();
$dog2->bow();

// ラブラドールからダルメシアンに変更
$dog ->setName('ダルメシアン');
echo $dog->getName()."という犬種です。<br>";

$pochi->bow();

// $dog->hand();
/* Dog クラスにはhand() が定義されてないのでエラーになる */

$pochi->hand();
// お手はポチしかできない。