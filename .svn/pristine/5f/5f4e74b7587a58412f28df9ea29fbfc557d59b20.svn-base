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
$db = new db();

$sql = 'insert into recharge_bill(userid,money,way) values(?,?,2)';
$recharge = $db->prepare_insert($sql,array($bid_userid,$money*100));

$sql = 'select state,money from orders where serial_number=?';
$data = $db->prepare_query($sql,array($serial_number));
if($data[0]['state'] == 1){
	$moneys = 100*$money + $data[0]['money'];
	$sql = 'update orders set money=? , state=2 where serial_number=?';
	$result = $db->prepare_exec($sql,array($moneys,$serial_number));

	$sql = 'update bid_order set state=4 where id=?';
	$result = $db->prepare_exec($sql,array($tree_order_id));

}elseif($data[0]['state'] == 0){
	$sql = 'update orders set money=? , state=1 where serial_number=?';
	$result = $db->prepare_exec($sql,array(100*$money,$serial_number));

	$sql = 'update bid_order set state=3 where id=?';
	$result = $db->prepare_exec($sql,array($tree_order_id));
}


$weObj = new Wechat();
$user = user::getUserByUserId($bid_userid);
$title = '投标结果信息';
$remark = '找树网';
$url = './yusuanphone.php#bidhistory';
$keyword1 = $tree_order_id;
$keyword2 = ($data[0]['state'] == 0) ? '买家已付定金'.$money.'元' :'买家已付尾款'.$money.'元';
sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);

echo $result;

unset($weObj);
unset($db);
