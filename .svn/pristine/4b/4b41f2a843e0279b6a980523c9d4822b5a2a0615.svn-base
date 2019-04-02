<?php

require 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$db = new db();

$serial = $_GET['serial'];
$time = date('Y-m-d H:i:s',time());
$sql = 'update orders set order_switch=3,negotiation_time=? where serial_number=?';

$result = $db->prepare_exec($sql,array($time,$serial));
if($result){
	$weObj = new Wechat();
	$user = user::getUserByUserId(1);
	$first = '您有新的交易纠纷 需要处理！';
	$remark = '请尽快处理';
	$url = './admin/negotiation.html';
	$keyword = '卖家拒绝买家退回定金';
	sendMessage($user['wechatid'], $first, $keyword, $remark, $url,$weObj);
	unset($weObj);

	echo $time;
}
unset($db);


