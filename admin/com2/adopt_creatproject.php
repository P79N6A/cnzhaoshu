<?php 
require 'checkhost2.php';
require 'db3.php';

$phone = $_POST['phone'];
$qrcode = $_POST['qrcode'];

// 判断权限
$user = json_decode($_COOKIE['user'],true);
if(($user['role'] == 6) || ($user['role'] == 8)){

$db = new db();

// 查看此手机号的用户
$sql = 'select * from adopt_project where phone=? and qrcode=?';
$result1 = $db->prepare_query($sql,array($phone,$qrcode));

if($result1){
	$sql = 'update adopt_project set userid=? where id=?';
	$result3 = $db->prepare_exec($sql,array($user['userid'],$result1[0]['id']));
	if($result3){
		$return['return_code'] = '200';
		$return['return_msg'] = '添加成功';
	}else{
		$return['return_code'] = '201';
		$return['return_msg'] = '绑定失败,请重新绑定！';
	}
	
}else{
	$return['return_code'] = '400';
	$return['return_msg'] = '未查到此联系方式的项目';
}

echo json_encode($return);
unset($db);
	
}