<?php
// Healthクラス：健康に関する個人のパラメータ
class Health {
    private $name;
    private $age;
    private $gender;
    private $weight;
    private $height;
    private $bmi;
    
    // セッター、
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

    // ゲッター
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

    // BMIの計算
    public function getBmi() {
        $m_height = $this->height / 100; //cm をm に直す
        $m_height2 = pow($m_height,2); //身長の2 乗の値にする
        $bmi = $this->weight / $m_height2; // 体重/身長の2乗
        return $this->bmi = sprintf('%0.2f', $bmi);
    }

    public function clac(){
        return $this-> bmi / $this-> age*10;
    }
}