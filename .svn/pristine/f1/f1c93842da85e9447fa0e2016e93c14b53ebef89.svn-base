<?php
/*
生成邀请二维码
 */
// require 'checkhost.php';
require '../wechat/wechat.class.php';
require 'checkhost.php';
// require 'db2.php';
include 'qrcode.image.php'; 

$shopid = $_REQUEST['shopid'];


$weObj = new Wechat();

$qrcode = $weObj->getQRCode(1, 0, 2592000);
$ticket = $qrcode['ticket'];


$url = $weObj->getQRUrl($ticket);
$img = $weObj->http_get($url);

if (!$img) {
	$weObj->deleteAccessToken();
	$url = $weObj->getQRUrl($ticket);
	$img = $weObj->http_get($url);
}

file_put_contents('../qrinvite/'.$shopid.'.jpg', $img);

unset($img);


$image = imagecreatefromjpeg('../qrinvite/'.$shopid.'.jpg');

$logofile = $_SERVER['DOCUMENT_ROOT'].'/headimg/96/'.$shopid.'.jpg';

if (file_exists($logofile)){
	$logo = imagecreatefromjpeg($logofile);
} else {
	$logo = imagecreatefrompng('../img/qrlogo.png');
}


$image = QrcodeImage::logo($image, $logo);
$image = QrcodeImage::label($image, '邀请好友开店二维码');

imagejpeg($image, '../qrinvite/'.$shopid.'.jpg', 80);

unset($image);


?>