<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>bmi</title>
</head>
<body>
<form action="bmi_view.php" method="post">
  <table border="1">
    <tr>
      <td>名前</td>
      <td><input type="text" name="name"></td>
    </tr>
    <tr>
      <td>年齢</td>
      <td><input type="text" name="age"></td>
    </tr>
    <tr>
      <td>性別</td>
      <td>
        <input type="radio" name="gender" value="man">男
        <input type="radio" name="gender" value="woman">女
      </td>
    </tr>
    <tr>
      <td>体重(kg)</td>
      <td><input type="text" name="weight"></td>
    </tr>
    <tr>
      <td>身長(cm)</td>
      <td><input type="text" name="height"></td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" name="submit" value="送信">
        <input type="hidden" name="mode" value="白">
      </td>
    </tr>
  </table>
</form>
<?php
require_once "health.php";
if(isset($_POST["mode"])){
  $obj = new health();
  $obj->setName($_POST["name"]);
  $obj->setAge($_POST["age"]);
  $obj->setGender($_POST["gender"]);
  $obj->setWeight($_POST["weight"]);
  $obj->setHeight($_POST["height"]);

  $name = $obj->getName(); 
  $age = $obj->getAge();
  $gender = $obj->getGender();
  $bmi = $obj->getBmi();
  $weight = $obj->getWeight();
  $height = $obj->getHeight();

  echo <<<_result_
  <h2>診断結果</h2>
  <table border="1">
    <tr>
      <td>名前</td>
      <td>年齢</td>
      <td>性別</td>
      <td>BMI</td>
      <td>体重(kg)</td>
      <td>身長(cm)</td>
    </tr>
    <tr>
      <td>$name</td>
      <td>$age</td>
      <td>$gender</td>
      <td>$bmi</td>
      <td>$weight</td>
      <td>$height</td>
    </tr>
  </table>
_result_;
}
?>
</body>
</html>