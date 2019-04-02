<?php

require 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$db = new db();

$serial_number = $_GET['serial_number'];
$remark = $_GET['remark'];
$time = date('Y-m-d H:i:s',time());
$sql = 'update order_one set order_switch=9,order_switch_time=?,order_switch_remark=? where serial_number=?';

$result = $db->prepare_exec($sql,array($time,$remark,$serial_number));

if($result){
	$weObj = new Wechat();
	$user = user::getUserByUserId(1);
	$first = '您有新的交易纠纷需要处理！';
	$remark = '请尽快处理';
	$url = './admin/negotiation.html';
	$keyword = '买卖双方出现纠纷';
	sendMessage($user['wechatid'], $first, $keyword, $remark, $url,$weObj);
	unset($weObj);

	echo $time;
}
unset($db);

