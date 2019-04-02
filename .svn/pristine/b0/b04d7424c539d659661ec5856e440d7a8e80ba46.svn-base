<?php

require 'basic.php';
require 'db.php';

$userid = $_GET['userid'];
$name = time().rand(10000,99999);

$filename = '../shop/photo/o/'.$name.'.jpg';
$imgRawData = file_get_contents('php://input');
file_put_contents($filename, $imgRawData);



$image = imagecreatefromstring($imgRawData);
$image160 = basic::resizeImage($image, 160, 160);
$filenames = '../shop/photo/m/'.$name.'.jpg';
imagejpeg($image160, $filenames, 80);

$image960 = basic::resizeImage($image, 960, 960);
$filenames = '../shop/photo/b/'.$name.'.jpg';
imagejpeg($image960, $filenames, 80);

unset($image960);
unset($image160);


// 保存路径到数据库
// $db = new db();
// $sql = 'insert into shop_honor (image) values(?)';
// echo $db->prepare_exec( $sql, array($name));
// unset($db);



