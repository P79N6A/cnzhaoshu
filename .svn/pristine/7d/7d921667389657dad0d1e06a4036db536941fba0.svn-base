<?php 

require 'db2.php';
include 'user2.php';
require 'message_attribute.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$db = new db();

$bid_userid = $_GET['bid_userid'];
$tree_order_id = $_GET['tree_order_id'];
$remark = $_GET['remark'];

$sql = 'update bid_order set state=6 where userid=? and id=?';
$result = $db->prepare_exec( $sql, array($bid_userid,$tree_order_id) );

$sql = 'update orders set order_switch=3,order_switch_time=? ,order_switch_remark=? where tree_order_id=? and bid_userid=?';
$time = date('Y-m-d H:i:s',time());
$result = $db->prepare_exec($sql,array($time,$remark,$tree_order_id,$bid_userid));

if($result){
	$Messageattrbute = new Messageattrbute();
	$sql = 'select b.* from (select id,orderid from tree_order where id=? and userid=?) a left join (select * from tree_order where id=?) b on a.orderid=b.orderid';
	$orderinfo = $db->prepare_query($sql,array($tree_order_id,$bid_userid,$tree_order_id))[0]; 

	$sql = 'select serial_number from orders where tree_order_id=? and bid_userid=?';
	$serial_number = $db->prepare_query($sql,array($tree_order_id,$bid_userid))[0]['serial_number'];   

	$weObj = new Wechat();
	$user = user::getUserByUserId($bid_userid);
	$title = $Messageattrbute->Ordersattribute($orderinfo);
	$remark = $user['name'].' 申请退定金 希望您尽快处理'.$user['phone'];
	$url = './yusuanphone.php?bhway=2&bhid='.$serial_number.'#bidhistory';
	sendorderstop($user['wechatid'], $title, $orderinfo['name'], $orderinfo['count'], $remark, $url,$weObj);
	echo $serial_number;
	unset($weObj);
}

unset($db);

