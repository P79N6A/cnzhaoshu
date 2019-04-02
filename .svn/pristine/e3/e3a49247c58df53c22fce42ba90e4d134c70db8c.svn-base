<?php 

include 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$id = $_GET['id'];
$remark = $_GET['remark'];
$name = $_GET['name'];
$treeuserid = $_GET['treeuserid'];
$number = $_GET['number'];

if($id && $remark){
	$db = new db();
	$sql = 'update order_one set order_switch=2 ,order_switch_time=? ,order_switch_remark=? where id=?';
	$time = date('Y-m-d H:i:s',time());
	$result = $db->prepare_exec($sql , array($time,$remark,$id));

	if($result){
		$weObj = new Wechat();
		$user = user::getUserByUserId($treeuserid);
		$title = '有一位买家申请退定金 希望您尽快处理';
		$remark = '找树网';
		$url = './yusuanphone.php#bidhistory';
		sendorderstop($user['wechatid'], $title, $name, $number, $remark, $url,$weObj);
		echo $time;
	}
	unset($db);
}


