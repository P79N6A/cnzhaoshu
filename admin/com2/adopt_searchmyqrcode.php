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

	$sql = 'select * from adopt_tree where qrcode=?';
	$result = $db->prepare_query($sql,array($qrcode));
	if($result){

		$sql = 'select userid,projectname from adopt_project where id=?';
		$project = $db->prepare_query($sql,array($result[0]['project_id']));

		if($project[0]['userid'] == $userid){
			$return['return_code'] = '200';
			$return['return_msg'] = '成功';
			$result[0]['projectname'] = $project[0]['projectname'];
			$return['return_data'] = $result[0];
		}else{
			$return['return_code'] = '202';
			$return['return_msg'] = '您无权限操作此二维码';
		}
			
	}else{

		$sql = 'select projectname from adopt_project where id=?';
		$project = $db->prepare_query($sql,array($projectid));

		$return['return_code'] = '201';
		$return['return_msg'] = '此二维码未被使用';
		$return['return_data'] = $project[0];
	}
		
	echo json_encode($return);
	unset($db);
}
