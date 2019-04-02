<?php 

	require 'checkhost.php';
	require('db2.php');

	$id = $_GET['id'];
	$userid = $_GET['userid'];	
	!$userid && exit;
	$db = new db();
	if (isset($id)) {
		$sql = 'delete from tree_order_temp where id=? and userid=?';
		$result = $db->prepare_exec( $sql, array( $id , $userid ) );
		echo $result;
	}else{
		$orderid = $_GET['orderid'];
		$sql = 'delete from tree_order_temp where orderid=?';
		$result1 = $db->prepare_exec( $sql, array( $orderid ));
		
		$sql = 'delete from tree_order_index where id=?';
		$result2 = $db->prepare_exec( $sql, array( $orderid ));
		echo $result2;
	}
	unset($db);
























 ?>