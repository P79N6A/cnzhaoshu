<?php 
require 'db.php';
require 'qrcode.create.php';
require 'create.tenderimage.php';
require 'create.oneqrcodeimage.php';

	$orderid = $_GET['orderid'];
	// $tendering = $_GET['tendering'];
	// $time = $_GET['time'];
	// $db = new db();

	// if($tendering == 1){
	// 	$sql = 'update tree_order_index set tendering=?,expiration_date=? where id=?';
	// 	$result = $db->prepare_exec($sql,array($tendering,$time,$orderid));
		Createoneimage::create($orderid);
	// }else{
	// 	$sql = 'update tree_order_index set tendering=? where id=?';
	// 	$result = $db->prepare_exec($sql,array($tendering,$orderid));
	// }

	// unset($db);
	// echo json_encode($result);




