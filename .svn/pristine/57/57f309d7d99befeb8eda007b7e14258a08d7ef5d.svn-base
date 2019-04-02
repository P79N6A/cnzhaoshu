<?php 

require 'db2.php';
require 'qrcode.create.php';

$userid = $_POST['userid'];

$db = new db();

$sql = 'select * from map_group where userid = ?';

$result = $db->prepare_query($sql,array($userid));

if(!$result){
	$sql = 'insert into map_group(userid) values(?)';
	$result = $db->prepare_insert($sql,array($userid));

	$qrcode = QRcodeCreate::mapgroupqrcode($userid);
	$filename = '../mapgroupqrcode/'.$userid.'.png';
	imagepng($qrcode, $filename);

	echo $userid;
}else{
	if($result[0]['qxuserid']){
		echo $result[0]['qxuserid'];
	}else{
		echo false;
	}
}

unset($db);