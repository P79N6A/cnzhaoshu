<?php 

require 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$order_oneid = $_GET['order_oneid'];
$money = $_GET['money'];
$userid = $_GET['userid'];
$treeuserid = $_GET['treeuserid'];
$name = $_GET['name'];
$way = $_GET['way'];

$db = new db();

$time = date('Y-m-d H:i:s',time());

if($way == 1){
	$sql = 'update order_one set state=2,deposit=?,deposit_switch=1,deposit_time=? where id=?';
}else{
	$sql = 'update order_one set state=5,fullamount=?,fullamount_time=? where id=?';
}
	
$result = $db->prepare_exec($sql,array(100*$money,$time,$order_oneid));

$sql = 'insert into recharge_bill(userid,money,way,time) values(?,?,?,?)';
$result1 = $db->prepare_insert($sql,array($userid,100*$money,1+$way,$time));

$userinfo = user::getUserByUserId($userid);
$username = $userinfo['name'];
$weObj = new Wechat();
$user = user::getUserByUserId($treeuserid);

$title = ($way == 1) ? $username.'已付定金,希望您早日发货！' : $username.'已付全款,希望您早日发货！';

$remark = '来自找树网';
$url = './yusuanphone.php#managersell';
sendonetreepay($user['wechatid'], $title, $money, $name, $remark, $url,$weObj);

echo $result;

unset($db);
