<?php 
require 'checkhost.php';
require 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$db = new db();

$bid_userid = $_GET['bid_userid'];
$tree_order_id = $_GET['tree_order_id'];

$sql = 'update bid_order set state=5 where userid=? and id=?';
$result = $db->prepare_exec( $sql, array($bid_userid,$tree_order_id));
$time = date('Y:m:d H:i:s',time());
$sql = 'update orders set state=3 ,receipt_time=? where tree_order_id=? and bid_userid=?';
$result = $db->prepare_exec($sql,array($time,$tree_order_id,$bid_userid));

if($result){
	$weObj = new Wechat();
	$user = user::getUserByUserId($bid_userid);
	$title = '投标结果信息';
	$remark = '找树网';
	$url = './yusuanphone.php#bidhistory';
	$keyword1 = $tree_order_id;
	$keyword2 = '买家已收货,苗款五天后到达您的账户';
	sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);
	echo $result;
}

