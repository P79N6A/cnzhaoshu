<?php 
require 'checkhost2.php';
require 'db3.php';
$id = $_POST['id'];

// 判断权限
$user = json_decode($_COOKIE['user'],true);
if($user['role'] != 8) exit;

$db = new db();

$sql = 'delete from adopt_project where id=?';
$result = $db->prepare_exec($sql,array($id));

if($result){
	$return['return_code'] = '200';
	$return['return_msg'] = '删除成功';
}else{
	$return['return_code'] = '400';
	$return['return_msg'] = '删除失败';
}

echo json_encode($return);
unset($db);