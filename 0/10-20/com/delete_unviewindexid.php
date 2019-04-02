<?php 
require 'checkhost.php';
require 'db2.php';
include 'user2.php';
require '../wechat/wechat.class.php';
require '../wechat/message.audit1.php';
	
	$orderid = $_GET['orderid'];
	$id = $_GET['id'];
	$count = $_GET['count'];
	$db = new db();

	$sql = 'delete from tree_order where orderid=? and id=?';
	$result = $db->prepare_exec($sql,array($orderid,$id));
	if($count == 1){
		$sql = 'select userid from tree_order_index where id=?';
		$userid = $db->prepare_query($sql,array($orderid))[0]['userid'];

		$sql = 'delete from tree_order_index where id=?';
		$result = $db->prepare_exec($sql,array($orderid));
		$weObj = new Wechat();
		$user = user::getUserByUserId($userid);
		$title = '审核信息';
		$remark = '找树网';
		$url = 'yusuanphone.php?show=1';
		$keyword = '您的审核未通过!';
		sendMessage($user['wechatid'] , $title, $keyword, $remark, $url,$weObj);
	}

	echo $result;
	unset($db);

