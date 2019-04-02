<?php 

require 'db.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$id = $_GET['id'];
$db = new db();

$sql = 'update order_one set order_switch = 5 where id=? and order_switch = 1';
$result1 = $db->prepare_exec($sql , array($id));

$sql = 'select userid,serial_number from order_one where id=?';
$result = $db->prepare_query($sql , array($id))[0];

if($result){
	$weObj = new Wechat();
	$user = user::getUserByUserId($result['userid']);
	$title = '供应商申请定金';
	$remark = '找树网';
	$url = './yusuanphone.php#managerbuy';
	$keyword = '编号：'.$result['serial_number'];
	sendMessage($user['wechatid'], $title, $keyword, $remark, $url,$weObj);
}

echo $result1;

unset($db);
