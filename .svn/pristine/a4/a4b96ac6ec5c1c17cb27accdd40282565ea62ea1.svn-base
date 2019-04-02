<?php 

require 'db.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$id = $_GET['id'];
$db = new db();

$time = date('Y-m-d H:i:s',time());
$sql = 'update order_one set delivery_time = ? where id=?';
$result1 = $db->prepare_exec($sql , array($time,$id));

$sql = 'select a.userid,a.serial_number,b.name from (select userid,serial_number,treeid from order_one where id=?) a left join (select treeid,name from tree) b on a.treeid=b.treeid';
$result = $db->prepare_query($sql , array($id))[0];

if($result){
	$weObj = new Wechat();
	
	$user = user::getUserByUserId($result['userid']);
	$title = '您的订单已经发货了';
	$remark = '找树网';
	$url = 'yusuanphone.php#bidhistory';
	$keyword1 = $result['name'];
	$keyword2 = $result['serial_number'];
	shipping($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);
}

echo $result1;

unset($db);
