<?php 
require 'checkhost.php';
require 'db2.php';
require 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';

$userid = $_GET['userid'];
$isrenzheng = $_GET['isrenzheng']-2;
$way = $_GET['way'];

$db = new db();

if($isrenzheng == 1){
	$name = '开通认证店';
	$money = 1500;
}else{
	$name = '开通旗舰店';
	$money = 1900;
}

$weObj = new Wechat();
$time = date('Y-m-d H:i:s',time());
$sql = 'update user set isrenzheng = ?,rz_time = ?,dianmi=dianmi+? where userid=?';
$result = $db->prepare_exec($sql,array($isrenzheng,$time,$money,$userid));

$user1 = user::getUserByUserId($userid);
$first = '恭喜您的审核通过了！';
$remark = '---找树网';
$url = '';
sendonetreepay($user1['wechatid'], $first, $money, $name, $remark, $url, $weObj);
echo $result;
unset($db);