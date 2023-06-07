<?php

class Pochi extends Dog
// extends：継承を表す。PochiはDogを継承している。
{
	function __construct($name = "ポチ", $weight = 40)
	{
		parent::__construct($name, $weight);
	}

	function bow()
	{
		print("{$this->getName()} は無駄吠えしない。かしこい<br>");
	}

	function hand()
	{
		print("{$this->getName()} はお手した🐾かわいい<br>");
	}
}