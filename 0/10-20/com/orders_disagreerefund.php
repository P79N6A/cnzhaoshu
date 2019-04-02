<?php
require 'checkhost.php';
require 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$db = new db();

$serial = $_GET['serial'];
$userid = $_GET['userid'];
$id = $_GET['id'];

$sql = 'update bid_order set state=16 where userid=? and id=?';
$result = $db->prepare_exec($sql,array($userid,$id));

if($serial){
	$sql = 'update orders set order_switch=9 where serial_number=?';
	$result = $db->prepare_exec($sql,array($serial));
}else{
	$sql = 'select serial_number from orders where bid_userid=? and tree_order_id=?';
	$serial_number = $db->prepare_query($sql,array($userid,$id))[0]['serial_number'];

	$sql = 'update orders set order_switch=9 where serial_number=?';
	$result = $db->prepare_exec($sql,array($serial_number));
}
	
$weObj = new Wechat();
$user = user::getUserByUserId(1);
$first = '您有新的交易纠纷 需要处理！';
$remark = '请尽快处理';
$url = './admin/negotiation.html';
$keyword = '卖家拒绝买家收回定金';
sendMessage($user['wechatid'], $first, $keyword, $remark, $url,$weObj);
echo $result;
unset($weObj);
unset($db);


