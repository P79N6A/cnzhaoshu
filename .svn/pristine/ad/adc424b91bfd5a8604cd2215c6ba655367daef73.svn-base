<?php
// 审核会员
require 'checkhost.php';
require 'db2.php';

$istrader = $_GET['state'];

$db = new db();

if ($istrader==1) {
	$phone = $_GET['phone'];
	$sql = 'update user set istrader=? where phone=?';
	$db->prepare_exec($sql, array($istrader, $phone)); 

	$sql = "select userid,name,phone from user where phone=?";	
	$result = $db->prepare_query($sql, array($phone));	
	echo json_encode($result);
} else {
	$userid = $_GET['userid'];
	$sql = 'update user set istrader=? where userid=?';
	$db->prepare_exec($sql, array($istrader, $userid)); 	
}

unset($db);

?>