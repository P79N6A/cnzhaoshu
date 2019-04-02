<?php 

require 'db.php';
$db = new db();

// 判断权限
// if($_COOKIE['user']['role'] !== 9) exit;

$sql = 'select a.*,b.username,b.phone from adopt_project a left join adopt_user b on a.userid=b.id';
$project = $db->query($sql);

if ($project) {
	$return['return_code'] = '200';
	$return['return_msg'] = '成功';
	$return['data'] = $project;
} else {
	$return['return_code'] = '201';
	$return['return_msg'] = '无数据';
}
echo json_encode($return);
unset($db);