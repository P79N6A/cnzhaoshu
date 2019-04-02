<?php 
require 'checkhost.php';
require 'db2.php';

	$id = $_GET['id'];
	$userid = $_GET['userid'];
	$orderid = $_GET['orderid'];
	$db = new db();
	$sql = 'update bid_order set state=-1 where id=? and userid=? and orderid=?';
	$result = $db->prepare_exec($sql,array($id,$userid,$orderid));

	echo $result;
	unset($db);

