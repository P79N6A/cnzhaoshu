<?php 
require 'db2.php';
require 'qrcode.create.php';
require 'create.tenderimage.php';
require 'create.orderqrcodeimage.php';
require 'create.oneqrcodeimage.php';
require '../wechat/wechat.class.php';
require '../wechat/message.audit1.php';
require 'Curl.class.php';


	$orderid = $_GET['orderid'];
	$time = $_GET['time'];
	$db = new db();

	$sql = 'update tree_order_index set expiration_date=? where id=?';
	$result = $db->prepare_exec($sql,array($time,$orderid));

	$sql = 'select qrcode from tree_order_index where id=?';
	$qrcode = $db->prepare_query($sql,array($orderid))[0]['qrcode'];


	$weObj = new Wechat();
	$sql = 'select * from tree_order where orderid=?';
	$data = $db->prepare_query($sql,array($orderid));
	if(count($data) == 1){
		$imagename = Createoneimage::create($orderid,$qrcode);
	}else{
		$imagename = Createimage::create($orderid,$qrcode);
	}

	echo $imagename;
	unset($db);




