<?php 

require 'db.php';
$db = new db();

$qrcode = $_GET['qrcode'];

// 获取cookie里的projectid
// $projectid = cookie('user2.projectid');
$projectid = 1;
if(!$qrcode)exit;
$db = new db();

$sql = 'select * from adopt_treeprice where project_id=?';
if($sql){
	$return['return_code'] = '200';
	$return['return_msg'] = '成功';
	$return['return_data'] = $db->prepare_query($sql,array($projectid));
}else{
	$return['return_code'] = '201';
	$return['return_msg'] = '项目缺少价格信息';
}
	
	
echo json_encode($return);
unset($db);