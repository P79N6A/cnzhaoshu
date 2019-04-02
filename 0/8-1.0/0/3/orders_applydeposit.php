<?php 

require 'db.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$serial = $_GET['serial'];
$userid = $_GET['userid'];
$id = $_GET['id'];
$orderid = $_GET['orderid'];
$db = new db();

$sql = 'update orders set order_switch = 5 where serial_number=? and order_switch = 1';
$result = $db->prepare_exec($sql , array($serial));

$sql = 'select qrcode from tree_order_index where id=?';
$qrcode = $db->prepare_query($sql , array($orderid))[0]['qrcode'];

if($result){
	$weObj = new Wechat();
	$user = user::getUserByUserId($userid);
	$title = '供应商申请定金';
	$remark = '找树网';
	$url = './qrcodeorder.php?id='.$qrcode.'&treeid='.$id;
	$keyword = '编号：'.$id;
	sendMessage($user['wechatid'], $title, $keyword, $remark, $url,$weObj);
}

echo $result;

unset($db);
