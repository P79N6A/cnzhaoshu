<?php 
	require 'checkhost.php';
	require('db2.php');
	
	// 获取参数
	$userid = $_GET['userid'];
	$state = $_GET['state'];
	
	if ($userid) {
		$db = new db();
		$sql = 'select * from tree_order_index where userid=? and state =?';
		$result = $db->prepare_query($sql,array($userid,$state));
		echo json_encode($result);
		unset($db);
	}

























 ?>