<?php 
require 'checkhost2.php';
require 'db3.php';

$qrcode = $_GET['qrcode'];

$user = json_decode($_COOKIE['user'],true);

if(($user['role'] == 6) || ($user['role'] == 8)){
	$db = new db();
	$userid = $user['userid'];
	if(!$qrcode)exit;
	$db = new db();

	$sql = 'select id from adopt_project where userid=?';
	$projectid = $db->prepare_query($sql,array($userid))[0]['id'];

	$sql = 'select * from adopt_treeprice where project_id=?';
	$result = $db->prepare_query($sql,array($projectid));
	if($sql){
		$return['return_code'] = '200';
		$return['return_msg'] = '成功';
		$return['return_data'] = $result;
	}else{
		$return['return_code'] = '201';
		$return['return_msg'] = '项目缺少价格信息';
	}
		
		
	echo json_encode($return);
	unset($db);
}