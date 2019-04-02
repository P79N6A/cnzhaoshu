<?php 
require 'checkhost.php';
require 'db2.php';

	
	$userid = $_GET['userid'];
	$db = new db();
	$sql = 'select count(id) from tree_order_index where userid=? and state=1 and tendering != 2';
	$result1 = $db->prepare_query($sql,array($userid))[0]['count(id)'];

	$sql = 'select count(userid) from bid_order where userid=? and state=1';
	$result2 = $db->prepare_query($sql,array($userid))[0]['count(userid)'];

	$data = array();
	$data['tendernumber'] = $result1;
	$data['bidnumber'] = $result2;
	echo json_encode($data);
	unset($db);

