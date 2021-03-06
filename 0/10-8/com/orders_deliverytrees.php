<?php 

require 'db2.php';
include 'user2.php';
require 'message_attribute.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$db = new db();

$bid_userid = $_GET['userid'];
$tree_order_id = $_GET['id'];
$serial = $_GET['serial'];
$tender_userid = $_GET['tender_userid'];
$orderid = $_GET['orderid'];

$sql = 'update bid_order set state=12 where userid=? and id=?';
$result = $db->prepare_exec( $sql, array($bid_userid,$tree_order_id));

$sql = 'update orders set delivery_time=?, state=8 where serial_number=?';
$time = date('Y-m-d H:i:s',time());
$result = $db->prepare_exec($sql,array($time,$serial));

if($result){

	$sql = 'select qrcode from tree_order_index where id=?';
	$qrcode = $db->prepare_query($sql , array($orderid))[0]['qrcode'];

	$sql = 'select * from tree_order where orderid=? and id=?';
	$orderinfo = $db->prepare_query($sql,array($orderid,$tree_order_id))[0];	

	$weObj = new Wechat();
	$Messageattrbute = new Messageattrbute();
	$user = user::getUserByUserId($tender_userid);

	$biduser = user::getUserByUserId($bid_userid);
	$title = $Messageattrbute->Ordersattribute($orderinfo);
	$url = './qrcodeorder.php?id='.$qrcode.'&treeid='.$tree_order_id;
	$keyword1 = $serial;
	$keyword2 = '您的订单已经在路上了';

	$remark = $biduser['name'].$biduser['phone'];
	sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);

	echo $result;
	unset($weObj);
}

unset($db);

