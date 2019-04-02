<?php
// 更新旗舰店实景
require 'checkhost.php';
require 'db2.php';
include 'basic.php';
include 'user2.php';

$userid = $_GET['userid'];


$filename = '../shop/photo/o/'.$userid.'.jpg';
$imgRawData = file_get_contents('php://input');
file_put_contents($filename, $imgRawData);

$image = imagecreatefromstring($imgRawData);
unset($imgRawData);


$image340 = basic::resizeImage($image, 340, 340);
$image340 = basic::squareImage($image340);
$filename = '../shop/photo/m/'.$userid.'.jpg';
imagejpeg($image340, $filename, 80);

imagedestroy($image);
imagedestroy($image340);

// 更新用户version
user::update($userid, 'version=version+1');
