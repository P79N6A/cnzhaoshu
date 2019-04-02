<?php 

	require 'db2.php';

	$orderid = $_GET['orderid'];
	$id = $_GET['id'];
	
	$db = new db();
	$sql = 'delete from tree_order where orderid=? and id=?';
	$result = $db->prepare_exec($sql,array($orderid,$id));
	
	$sql = 'delete from bid_order where orderid=? and id=?';
	$result = $db->prepare_exec($sql,array($orderid,$id));

	unset($db);
	echo $result;


 ?>