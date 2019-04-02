<?php
// 更新logo头像
include 'basic.php';
include 'db.php';
include 'user2.php';

$userid = $_GET['userid'];


$imgRawData = file_get_contents('php://input');
$image = imagecreatefromstring($imgRawData);
unset($imgRawData);

$image = basic::resizeImage($image, 960, 960);
$image0 = basic::squareImage($image);
            
$filename = '../headimg/0/'.$userid.'.jpg';
imagejpeg($image0, $filename, 80);

$image96 = basic::resizeImage($image0, 96, 96);
$filename = '../headimg/96/'.$userid.'.jpg';
imagejpeg($image96, $filename, 80);

imagedestroy($image);
imagedestroy($image0);
imagedestroy($image96);

// 更新用户version
user::update($userid, 'version=version+1');
