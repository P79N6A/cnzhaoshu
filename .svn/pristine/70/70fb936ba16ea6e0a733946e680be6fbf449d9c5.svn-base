<?php 
require 'checkhost.php';
require('db2.php');

	
	$userid = $_GET['userid'];
	$orderid = $_GET['orderid'];
	$db = new db();
	$sql = 'select a.name,b.ordername from (select name,phone,userid from user where userid=?) a left join (select ordername,address,userid from tree_order_index where id=?) b on a.userid=b.userid';
	$result = $db->prepare_query($sql,array($userid,$orderid))[0];
	echo json_encode($result);
	unset($db);

