<?php 
require 'checkhost.php';
require 'db2.php';

	
	$orderid = $_GET['orderid'];
	$db = new db();

	$sql = 'select * from tree_order where orderid=?';
	$result = $db->prepare_query($sql,array($orderid));
	echo json_encode($result);
	
	unset($db);

