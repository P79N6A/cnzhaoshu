<?php 
require 'checkhost.php';
include 'db2.php';
include 'user2.php';
require 'message_attribute.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$id = $_GET['id'];
$remark = $_GET['remark'];

if($id && $remark){
	$db = new db();
	$sql = 'update order_one set order_switch=3 ,order_switch_time=? ,order_switch_remark=? where id=?';
	$time = date('Y-m-d H:i:s',time());
	$result = $db->prepare_exec($sql , array($time,$remark,$id));

	$sql = 'select a.treeuserid,a.userid buyuserid,a.serial_number,a.number,b.* from (select * from order_one where id=?) a left join (select * from tree) b on a.treeuserid=b.userid and a.treeid=b.treeid';
	$orderinfo = $db->prepare_query($sql,array($id))[0];

	if($result){

		$Messageattrbute = new Messageattrbute();
		$title = $Messageattrbute->Order_oneattribute($orderinfo);

		$weObj = new Wechat();
		$treeuser = user::getUserByUserId($orderinfo['treeuserid']);
		$user = user::getUserByUserId($orderinfo['buyuserid']);

		$remark = $user['name'].$user['phone'].'-----找树网';
		$url = './yusuanphone.php?msway=2&msid='.$orderinfo['serial_number'].'#managersell';

		sendorderstop($treeuser['wechatid'], $title, $orderinfo['name'], $orderinfo['number'], $remark, $url,$weObj);
		echo $time;
	}
	unset($db);
}


