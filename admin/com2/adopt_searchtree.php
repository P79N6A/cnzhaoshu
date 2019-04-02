<?php 
require 'checkhost2.php';
require 'db3.php';
$db = new db();

// 判断权限
$user = json_decode($_COOKIE['user'],true);

if(($user['role'] == 6) || ($user['role'] == 8)){

	$userid = $user['userid'];

	// 判断身份是否有权限
	$sql = 'select id from adopt_project where userid=?';
	$result = $db->prepare_query($sql,array($userid));
	if($result){
		$sql = 'select * from adopt_tree where project_id=?';
		$treelist = $db->prepare_query($sql,array($result[0]['id']));
	}
	if($result){
		if($result && $treelist){
			$return['return_code'] = '200';
			$return['return_msg'] = '成功';
			$return['return_data'] = $treelist;
		}else{
			$return['return_code'] = '201';
			$return['return_msg'] = '暂无数据';
		}
	}else{
		$return['return_code'] = '400';
		$return['return_msg'] = '出错';
	}
		

	echo json_encode($return);
	unset($db);
}