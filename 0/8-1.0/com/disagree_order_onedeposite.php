<?php 

require 'db.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';


$id = $_GET['id'];

$db = new db();

$time = date('Y-m-d H:i:s',time());
$sql = 'update order_one set order_switch = 9,order_switch_time=? where id=?';

$result = $db->prepare_exec($sql , array($time,$id));

$sql = 'select userid,serial_number from order_one where id=?';
$result = $db->prepare_query($sql , array($id))[0];

if($result){
	$weObj = new Wechat();
	$user = user::getUserByUserId(29908);
	$title = '定金纠纷';
	$remark = '找树网';
	$url = './admin/negotiation.html';
	$keyword = '编号：'.$result['serial_number'];
	sendMessage($user['wechatid'], $title, $keyword, $remark, $url,$weObj);
}

echo $time;

unset($db);
