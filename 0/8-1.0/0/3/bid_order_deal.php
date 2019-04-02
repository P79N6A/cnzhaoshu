<?php 
require 'db.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';
$weObj = new Wechat();

	$id = $_GET['id'];
	$supplierid = $_GET['supplierid'];
	$orderid = $_GET['orderid'];

	$db = new db();
	$sql = 'update bid_order set state=2 where id=? and userid=? and orderid=?';
	$result = $db->prepare_exec($sql,array($id,$supplierid,$orderid));

	$user = user::getUserByUserId($supplierid);
	$title = '投标结果信息';
	$remark = '找树网';
	$url = 'yusuanphone.php#bidhistory';
	$keyword1 = $id;
	$keyword2 = '已中标!';
	sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);
	
	echo $result;
	unset($db);

