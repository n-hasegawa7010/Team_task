<?php
class Health {
 private $name;
 private $age;
 private $gender;
 private $weight;
 private $height;
 private $bmi;

public function setName($name) {
	$this->name = htmlentities($name,ENT_QUOTES,"utf-8");
}
public function setAge($age) {
	$this->age = htmlentities($age,ENT_QUOTES,"utf-8");
}
public function setGender($gender) {
	$this->gender = htmlentities($gender,ENT_QUOTES,"utf-8");
}
public function setWeight($weight) {
	$this->weight = htmlentities($weight,ENT_QUOTES,"utf-8");
}
public function setHeight($height) {
	$this->height = htmlentities($height,ENT_QUOTES,"utf-8");
}

public function getName() {
	 return $this->name;
}
public function getAge() {
	return $this->age;
}
public function getGender() {
	return $this->gender;
}
public function getWeight() {
	return $this->weight;
}
public function getHeight() {
	return $this->height;
}
public function getBmi() {
	$height =  $this->height / 100 ;
	$height =  pow($height,2);
	$bmi = $this->weight /$height ;
	return $this->bmi = sprintf('%0.2f', $bmi);
}
public function write(){
	$result = array($this->name,$this->age,$this->gender,$this->bmi,$this->height,$this->weight);
	$fp = fopen('file.csv', 'a+');
	fputcsv($fp,$result);
	fclose($fp);
}

#------------------------------
#         体重(kg)
# BMI=-------------------
#     (身長(m)×身長(m))
#------------------------------

}
?>