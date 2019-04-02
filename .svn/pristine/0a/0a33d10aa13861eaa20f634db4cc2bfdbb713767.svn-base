<?php 
require 'checkhost.php';
require 'db2.php';

$userid = $_POST['userid'];
$qrcode = $_POST['qrcode'];
$mapid = $_POST['mapid'];
if($mapid && $qrcode && $userid){
	$db = new db();
	$sql = 'select userid from maps_order where qrcode = ?';
	$result = $db->prepare_query($sql,array($qrcode));
	if($result){
		if($result[0]['userid'] == $userid){
			echo '-1';
		}else{
			echo '-2';
		}
	}else{
		$sql = 'insert into maps_order(userid,qrcode,map_id) values(?,?,?)';
		$result = $db->prepare_insert($sql,array($userid,$qrcode,$mapid));

		$sql = 'select count(id) from maps_order where map_id=?';
		$count = $db->prepare_query($sql,array($mapid));
		echo $count[0]['count(id)'];
	}
	unset($db);
}

