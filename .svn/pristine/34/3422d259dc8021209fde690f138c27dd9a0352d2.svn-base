<?php

require 'basic.php';
require 'db.php';

$shopid = $_GET['userid'];
 
// 保存路径到数据库
$db = new db();
$sql = 'insert into shop_honor (shopid) values(?)';
$honorid = $db->prepare_insert($sql, array($shopid));
unset($db);

if ($honorid) {
	$filename = '../shop/honor/o/'.$honorid.'.jpg';
	$imgRawData = file_get_contents('php://input');
	file_put_contents($filename, $imgRawData);

	$image = imagecreatefromstring($imgRawData);
	unset($imgRawData);

	$image960 = basic::resizeImage($image, 960, 960);
	$image960 = basic::squareImage($image960);
	$filename = '../shop/honor/b/'.$honorid.'.jpg';
	imagejpeg($image960, $filename, 80);
	
	$image160 = basic::resizeImage($image, 160, 160);
	$filename = '../shop/honor/m/'.$honorid.'.jpg';
	imagejpeg($image160, $filename, 80);

imagedestroy($image);
imagedestroy($image960);
imagedestroy($image160);
	echo $honorid;

}

