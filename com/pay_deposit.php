<?php 
require 'db.php';
include 'user2.php';
require '../wechat/message.audit1.php';

	$id = $_GET['id'];
	$supplierid = $_GET['supplierid'];
	$orderid = $_GET['orderid'];
	$userid = $_GET['userid'];

	$db = new db();
	$sql = 'update bid_order set state=3 where id=? and userid=? and orderid=?';
	$result = $db->prepare_exec($sql,array($id,$supplierid,$orderid));

	$user = user::getUserByUserId($userid);
	$title = '报价信息';
	$remark = '找树网';
	$url = 'qwe/phone_tree4.html';
	$keyword = '恭喜! 您的一条苗木买家已付定金了!';
	sendMessage($user['wechatid'], $title, $keyword, $remark, $url);

	echo $result;
	unset($db);

