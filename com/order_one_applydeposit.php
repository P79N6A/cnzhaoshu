<?php 

require 'db2.php';
include 'user2.php';
require 'message_attribute.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$id = $_GET['id'];
$db = new db();

$Messageattrbute = new Messageattrbute();
$time = date('Y-m-d H:i:s',time());

$sql = 'update order_one set order_switch = 5,order_switch_time=? where id=? and order_switch = 1';
$result = $db->prepare_exec($sql , array($time,$id));

$sql = 'select a.treeuserid,a.userid buyuserid,a.serial_number,b.* from (select * from order_one where id=?) a left join (select * from tree) b on a.treeuserid=b.userid and a.treeid=b.treeid';
$orderinfo = $db->prepare_query($sql,array($id))[0];

if($result && $orderinfo){
	$weObj = new Wechat();
	$userinfo = user::getUserByUserId($orderinfo['buyuserid']);

	$user = user::getUserByUserId($orderinfo['treeuserid']);
	$username = $user['name'];
	$userphone = $user['phone'];

	$title = $Messageattrbute->Order_oneattribute($orderinfo);
	$remark = '找树网';
	$url = './yusuanphone.php?mbway=2&mbid='.$orderinfo['serial_number'].'#managerbuy';
	$keyword = '申请定金 '.$username.$userphone;
	sendMessage($userinfo['wechatid'], $title, $keyword, $remark, $url,$weObj);
}

echo $result;
unset($db);
