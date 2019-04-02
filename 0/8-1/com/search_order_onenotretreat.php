<?php
require 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$userid = $_GET['userid'];
$id = $_GET['id'];

$db = new db();

$sql = 'update order_one set order_switch=3 where id=?';
$result = $db->prepare_exec($sql,array($id));

if($result){
	$weObj = new Wechat();
	$user = user::getUserByUserId(1);
	$first = '您有新的退定金纠纷 需要审核处理！';
	$remark = '请尽快处理';
	$url = './admin/negotiation.html';
	$keyword = '卖家不同意退还定金';
	sendMessage($user['wechatid'], $first, $keyword, $remark, $url,$weObj);
	echo $result;
	unset($weObj);

}
unset($db);
