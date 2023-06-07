<?php

class Dog
{
	private $name;
	private $weight;

	// new Dog()を呼び出した時に実行される関数
	// デフォルトが'イヌ'という名前で、体重が50kg
	public function __construct($name = "イヌ", $weight = 50)
	{
		// $this：このクラスのインスタンスを指す。
		$this->setName($name);
		$this->setWeight($weight);
	}

	public function bow()
	{
		print("{$this->getName()} < ワンワン！！<br>");
	}

	/* アクセサメソッド(getter, setter) */
	public function setName($name)
	{
		$this->name = $name;
	}
	public function getName()
	{
		return $this->name;
	}

	public function setWeight($weight = 50) /* 引数が設定されなかった場合のデフォルト値を指定できる */
	{
		if ($weight < 0)
		{
			$weight = 1;
		}
		$this->weight = $weight;
	}
	public function getWeight()
	{
		return $this->weight;
	}

}
