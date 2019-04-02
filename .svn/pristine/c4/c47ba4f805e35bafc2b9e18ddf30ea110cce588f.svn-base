<?php 
require 'checkhost.php';
require 'db2.php';

	
	$userid = $_GET['userid'];
	$db = new db();

	$sql = 'select role from user where userid=?';
	$result = $db->prepare_query($sql,array($userid))[0]['role'];
	if($result == 9){
		$sql = 'select * from tree_order_index where review_state = 0 and state=1';
		$result = $db->prepare_query($sql);
		echo json_encode($result);
	}
	unset($db);

