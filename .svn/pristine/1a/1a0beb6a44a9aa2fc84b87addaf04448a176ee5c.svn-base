<?php 

require 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$db = new db();

$bid_userid = $_GET['bid_userid'];
$tree_order_id = $_GET['tree_order_id'];

$sql = 'update bid_order set state=6 where userid=? and id=?';
$result = $db->prepare_exec( $sql, array($bid_userid,$tree_order_id) );

$sql = 'update orders set order_switch=2 where tree_order_id=? and bid_userid=?';
$result = $db->prepare_exec($sql,array($tree_order_id,$bid_userid));

if($result){
	$weObj = new Wechat();
	$user = user::getUserByUserId(1);
	$first = '您有新的交易纠纷 需要处理！';
	$remark = '请尽快处理';
	$url = './yusuanphone.php#bidhistory';
	$keyword = '卖家未收到货';
	sendMessage($user['wechatid'], $first, $keyword, $remark, $url,$weObj);
	echo $result;
	unset($weObj);

}

