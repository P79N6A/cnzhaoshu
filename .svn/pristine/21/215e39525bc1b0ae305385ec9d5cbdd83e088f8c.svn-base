<?php

require 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';


$serial_number = $_GET['serial_number'];
$money = (int)$_GET['money'];
$userid = $_GET['userid'];
$bid_userid = $_GET['bid_userid'];
$tree_order_id = $_GET['tree_order_id'];
$way = $_GET['way'];
$db = new db();

$time = date('Y-m-d H:i:s',time());

if($way == 1){
	$sql = 'update orders set deposit=? , deposit_time=? , deposit_switch=1 , state=1 where serial_number=?';
	$result = $db->prepare_exec($sql,array(100*$money,$time,$serial_number));

	$sql = 'update bid_order set state=3 where id=? and userid=?';
	$result = $db->prepare_exec($sql,array($tree_order_id,$bid_userid));

	$sql = 'insert into recharge_bill(userid,money,way,time) values(?,?,?,?)';
	$result = $db->prepare_insert($sql,array($userid,100*$money,2,$time));
}elseif($way == 2){
	$sql = 'update orders set fullamount=? , fullamount_time=? , state=2 where serial_number=?';
	$result = $db->prepare_exec($sql,array(100*$money,$time,$serial_number));

	$sql = 'update bid_order set state=4 where id=? and userid=?';
	$result = $db->prepare_exec($sql,array($tree_order_id,$bid_userid));

	$sql = 'insert into recharge_bill(userid,money,way,time) values(?,?,?,?)';
	$result = $db->prepare_insert($sql,array($userid,100*$money,3,$time));
}

$weObj = new Wechat();
$user = user::getUserByUserId($bid_userid);
$title = '投标结果信息';
$remark = '找树网';
$url = './yusuanphone.php#bidhistory';
$keyword1 = $tree_order_id;
$keyword2 = ($way == 1) ? '买家已付定金'.$money.'元' :'买家已付尾款'.$money.'元';
sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);

echo $result;

unset($weObj);
unset($db);

