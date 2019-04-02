<?php

	require 'db.php';
	require 'qrcode.create.php';

	$money = $_POST['money']*100;
	$userid = $_POST['userid'];

	$id = $userid.date('Ymdhis');

	$qrcodeimg = QRcodeCreate::sellersetmoney($id);

	$db = new db();

	$sql = 'insert into quick_payment(getuserid,money,qrcode) values(?,?,?)';

	$result = $db->prepare_insert($sql,array($userid,$money,$id));

	if($result){
		imagejpeg($qrcodeimg, '../payqrcode/'.$id.'.jpg');
		echo $id;
	}

	unset($db);