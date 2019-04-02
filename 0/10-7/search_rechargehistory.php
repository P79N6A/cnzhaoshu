<?php 
require 'db2.php';
	
	$userid = $_GET['userid'];
	$limit = $_GET['limit'];
	$limit = explode(',', $limit);
	$db = new db();
	$sql = 'select * from recharge_bill where userid=? order by time desc limit ?,?';
	$result = $db->prepare_query($sql,array($userid,$limit[0],$limit[1]));

	echo json_encode($result);
	unset($db);