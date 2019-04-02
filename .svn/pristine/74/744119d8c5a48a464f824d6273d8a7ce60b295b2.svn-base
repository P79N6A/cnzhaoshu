<?php 
require 'checkhost.php';
	require 'db2.php';
	include 'user2.php';
	require '../wechat/message.audit1.php';
	require '../wechat/wechat.class.php';	

	$supplierid = $_GET['supplierid'];
	$userid = $_GET['userid'];
	$state = $_GET['state'];
	$db = new db();


	if($state=='null'){
		$sql = 'insert into supplier(userid,supplier_id,state,stateb) values(?,?,1,1)';
		$result = $db->prepare_exec($sql,array($userid,$supplierid));
	}else{
		$sql = 'update supplier set state = 1 where userid=? and supplier_id=?';
		$result = $db->prepare_exec($sql,array($userid,$supplierid));
	}

	$weObj = new Wechat();
	$user = user::getUserByUserId($supplierid);
	$title = '';
	$remark = '找树网';
	$url = 'yusuanphone.php#customer';
	$keyword = '您有新的客户!';
	sendMessage($user['wechatid'], $title, $keyword, $remark, $url,$weObj);

	echo $result;

	unset($db);

