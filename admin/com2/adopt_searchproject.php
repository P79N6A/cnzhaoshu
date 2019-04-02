<?php 
require 'checkhost2.php';
require 'db3.php';
$db = new db();

// 判断权限
$user = json_decode($_COOKIE['user'],true);
if($user['role'] != 8) exit;

$sql = 'select a.*,b.username,b.phone from adopt_project a left join adopt_user b on a.userid=b.userid';
$project = $db->prepare_query($sql);

if ($project) {
	$return['return_code'] = '200';
	$return['return_msg'] = '成功';
	$return['return_data'] = $project;
} else {
	$return['return_code'] = '201';
	$return['return_msg'] = '无数据';
}
echo json_encode($return);
unset($db);