<?php 
require 'db2.php';
$qrcodeid = $_GET['qrcodeid'];
$userid = $_GET['userid'];
$db = new db();
$sql = 'select groupuser,id from map_order where qxqrcode=?';
$result = $db->prepare_query($sql,array($qrcodeid))[0];
$userids = explode(',', $result['groupuser']);
$nothas = true;
for ($i=0; $i < count($userids); $i++) { 
	if($userids[$i] == $userid){
		$nothas = false;
	}
}
if($nothas){
	if($result['groupuser']){
		$users = $result['groupuser'].','.$userid;
	}else{
		$users = $userid;
	}
	$sql = 'update map_order set groupuser = ? where id=?';
	$result = $db->prepare_exec($sql,array($users,$result['id']));
	echo $result;
}else{
	echo true;
}
unset($db);