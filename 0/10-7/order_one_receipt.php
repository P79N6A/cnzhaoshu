<?php 

include 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$id = $_GET['id'];
$userid = $_GET['userid'];
if($id){
	$db = new db();

	$sql = 'update order_one set receipt_time=? ,state=3 where id=?';
	$time = date('Y-m-d H:i:s',time());
	$result = $db->prepare_exec($sql , array($time,$id));
	
	if($result){
		$weObj = new Wechat();
		$user = user::getUserByUserId($userid);
		$title = '投标结果信息';
		$remark = '找树网';
		$url = './managesell.php';
		$keyword1 = $tree_order_id;
		$keyword2 = '买家已收货,苗款五天后到达您的账户';
		sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);
		echo $time;
	}

	unset($db);
}


