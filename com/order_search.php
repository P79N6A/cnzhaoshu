<?php 
	require 'checkhost.php';
	require('db2.php');
	
	// 获取参数
	$orderid = $_GET['orderid'];
	$userid = $_GET['userid'];
	!$orderid && exit;
	$sql = 'select a.*,b.state from (select * from tree_order where orderid=?) a left join (select * from bid_order where userid=?) b on a.userid=b.userid and a.id=b.id and a.orderid=b.orderid';
	$db = new db();
	$result = $db->prepare_query($sql, array( $orderid , $userid ));
	unset($db);
	echo json_encode($result);
	