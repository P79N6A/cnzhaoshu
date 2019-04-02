<?php 
	require 'checkhost.php';
	require('db2.php');


	$orderid = $_GET['orderid'];	
	!$orderid && exit;
	$db = new db();
	
	$orderid = $_GET['orderid'];
	$sql = 'delete from tree_order_temp where orderid=?';
	$result = $db->prepare_exec( $sql, array( $orderid ));
	if($result){
		$sql = 'delete from tree_order_index where id=?';
		$result = $db->prepare_exec( $sql, array( $orderid ));
	}
	echo $result;
	
	unset($db);
























 ?>