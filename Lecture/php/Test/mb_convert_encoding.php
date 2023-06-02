<?php
$str = " インターネット･アカデミー";
$enc = mb_convert_encoding($str,"Shift_JIS","UTF-8");
echo $str . "<br>";
echo $enc;

?>