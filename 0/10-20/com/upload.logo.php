<?php
// 更新logo头像
require 'checkhost.php';
require 'db2.php';
require 'basic.php';
require 'user2.php';
require 'shop.qrcode.php';

$userid = $_GET['userid'];


$imgRawData = file_get_contents('php://input');
$image = imagecreatefromstring($imgRawData);
unset($imgRawData);

$image = basic::resizeImage($image, 960, 960);
$image0 = basic::squareImage($image);
imagedestroy($image);
            
$filename = '../headimg/0/'.$userid.'.jpg';
imagejpeg($image0, $filename, 80);


$image96 = basic::resizeImage($image0, 96, 96);
$filename = '../headimg/96/'.$userid.'.jpg';
imagejpeg($image96, $filename, 80);

imagedestroy($image0);
imagedestroy($image96);

// 生成新苗店二维码
$shopQrcode = new ShopQrcode();
$shopQrcode->create($userid);
unset($shopQrcode);

// 更新用户version
user::update($userid, 'version=version+1');
