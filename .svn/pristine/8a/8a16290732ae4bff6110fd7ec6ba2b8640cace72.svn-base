<?php 
require 'checkhost.php';
require 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$db = new db();

$bid_userid = $_GET['bid_userid'];
$tree_order_id = $_GET['tree_order_id'];
$remark = $_GET['remark'];

$sql = 'update bid_order set state=16 where userid=? and id=?';
$result = $db->prepare_exec( $sql, array($bid_userid,$tree_order_id) );

$time = date('Y-m-d H:i:s',time());
$sql = 'update orders set order_switch=9,order_switch_remark=?,order_switch_time=? where tree_order_id=? and bid_userid=?';
$result = $db->prepare_exec($sql,array($remark,$time,$tree_order_id,$bid_userid));

if($result){
	$weObj = new Wechat();
	$user = user::getUserByUserId(1);
	$first = '您有新的交易纠纷 需要处理！';
	$remark = '请尽快处理';
	$url = './admin/negotiation.html';
	$keyword = '买家拒绝收货';
	sendMessage($user['wechatid'], $first, $keyword, $remark, $url,$weObj);
	echo $result;
	unset($weObj);
}

