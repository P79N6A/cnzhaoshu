<?php 

include 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$serial_number = $_GET['serial_number'];
$remark = $_GET['remark'];
$name = $_GET['name'];
$treeuserid = $_GET['treeuserid'];
$number = $_GET['number'];

if($serial_number && $remark){
	$db = new db();
	$sql = 'update order_one set order_switch=2 ,order_switch_time=? ,order_switch_remark=? where serial_number=?';
	$time = date('Y-m-d H:i:s',time());
	$result = $db->prepare_exec($sql , array($time,$remark,$serial_number));

	if($result){
		$weObj = new Wechat();
		$user = user::getUserByUserId($treeuserid);
		$title = '买家申请退定金(编号：'.$serial_number.')';
		$remark = '找树网';
		$url = './yusuanphone.php#bidhistory';
		sendorderstop($user['wechatid'], $title, $name, $number, $remark, $url,$weObj);
		echo $time;
	}
	unset($db);
}


