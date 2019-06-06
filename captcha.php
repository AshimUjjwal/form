<?php


$str= md5(rand());

$string= substr($str,0,6);

Session_start();

$_SESSION['cap_code']= $string;

$img= imagecreate(100,50);

imagecolorallocate($img,255,255,255);

$txtcolor= imagecolorallocate($img,0,0,0);

imagestring($img,20,10,10,$string,$txtcolor);

header("content-type:image/png");

imagepng($img);

?>