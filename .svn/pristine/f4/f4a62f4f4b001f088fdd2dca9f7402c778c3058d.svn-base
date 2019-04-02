<?php 

require 'db.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$id = $_GET['id'];
$db = new db();

$sql = 'update order_one set order_switch = 5 where id=? and order_switch = 1';
$result1 = $db->prepare_exec($sql , array($id));

$sql = 'select userid,serial_number from order_one where id=?';
$result = $db->prepare_query($sql , array($id))[0];

if($result){
	$weObj = new Wechat();
	
	$user = user::getUserByUserId($supplierid);
	$title = '投标结果信息';
	$remark = '找树网';
	$url = 'yusuanphone.php#bidhistory';
	$keyword1 = $id;
	$keyword2 = '已中标!';
	sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);
	
}

echo $result1;

unset($db);
