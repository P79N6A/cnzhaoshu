<?php 

require 'db.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$db = new db();

$bid_userid = $_GET['bid_userid'];
$tree_order_id = $_GET['tree_order_id'];
$remark = $_GET['remark'];

$sql = 'update bid_order set state=6 where userid=? and id=?';
$result = $db->prepare_exec( $sql, array($bid_userid,$tree_order_id) );

$sql = 'update orders set order_switch=3,order_switch_time=? ,order_switch_remark=? where tree_order_id=? and bid_userid=?';
$time = date('Y-m-d H:i:s',time());
$result = $db->prepare_exec($sql,array($time,$remark,$tree_order_id,$bid_userid));

if($result){
	$sql = 'select a.number,b.name from (select number,orderid from bid_order where userid=? and id=?) a left join (select name,orderid from tree_order where id=?) b on a.orderid=b.orderid';
	$info = $db->prepare_query( $sql, array($bid_userid,$tree_order_id,$tree_order_id))[0];

	$weObj = new Wechat();
	$user = user::getUserByUserId($bid_userid);
	$title = '买家申请退定金 希望您尽快处理';
	$remark = '找树网';
	$url = './yusuanphone.php#bidhistory';
	sendorderstop($user['wechatid'], $title, $info['name'], $info['number'], $remark, $url,$weObj);
	echo $result;
	unset($weObj);
}

unset($db);

