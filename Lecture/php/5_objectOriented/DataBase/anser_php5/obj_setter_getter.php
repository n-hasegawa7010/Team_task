<?php
class Profile {
 private $name = "";
 public function setName($name) {
 $this->name = $name;
 }
 public function getName() {
 return $this->name;
 }
 }
?>
<!DOCTYPE html>
<html>
<head>
<title>getter</title>
</head>
<body>
<?php
 $a = new Profile;
 $a->setName(" 山田太郎");
 $b = new Profile;
 $b->setName(" 山田次郎");
 echo $a->getName() . "<br>";
 echo $b->getName();
?>
</body>
</html>