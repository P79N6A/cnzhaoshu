<?php

require 'db2.php';
require 'qrcode.create.php';

$db = new db();

$userid = $_GET['userid'];
$name = $_GET['name'];
$x = $_GET['x'];
$y = $_GET['y'];
$address = $_GET['address'];
if($userid){
	$qrcodeid = get_total_millisecond();
	$sql = 'insert into map(userid,qrcode,x,y,name,address) values(?,?,?,?,?,?)';
	$result = $db->prepare_insert($sql,array($userid,$qrcodeid,$x,$y,$name,$address));

	$qrcode1 = QRcodeCreate::mapqrcode($qrcodeid);
	$filename1 = '../mapqrcode/'.$qrcodeid.'.png';
	imagepng($qrcode1, $filename1);

	$qrcode2 = QRcodeCreate::shareprojectqx($qrcodeid);
	$filename2 = '../shareprojectqx/'.$qrcodeid.'.png';
	imagepng($qrcode2, $filename2);
	if($result){
		echo $qrcodeid;
	}
}

function get_total_millisecond(){  
	$date = date('YmdHis',time());
    $time = explode (" ", microtime () );   
    $time = 100000 + (int)($time [0] * 100000);
    return ($date . $time); 
}