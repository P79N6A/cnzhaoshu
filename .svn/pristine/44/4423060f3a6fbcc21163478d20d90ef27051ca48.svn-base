<?php 
require 'db2.php';
require 'checkhost.php';

	$orderid = $_GET['orderid'];
	$tendering = $_GET['tendering'];
	$db = new db();

	$sql = 'update tree_order_index set tendering=? where id=?';
	$result = $db->prepare_exec($sql,array($tendering,$orderid));

	$sql = 'update bid_order set state=-1 where orderid=? and (state = 0 or state = 1)';
	$result = $db->prepare_exec($sql,array($orderid));


	unset($db);
	echo json_encode($result);

