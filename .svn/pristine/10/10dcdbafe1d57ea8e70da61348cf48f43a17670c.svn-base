<?php 
require 'checkhost.php';
require('db2.php');

	
	$userid = $_GET['userid'];
	$limit = $_GET['limit'];
	$limit = explode(',',$limit);
	$db = new db();
	$sql = 'select supplier.userid,supplier.stateb,user.name,user.province,user.city,user.phone from supplier left join user on supplier.userid=user.userid where supplier.supplier_id=? and supplier.stateb = 1 limit ?,?';
	$result = $db->prepare_query($sql,array($userid,$limit[0],$limit[1]));
	echo json_encode($result);
	unset($db);

