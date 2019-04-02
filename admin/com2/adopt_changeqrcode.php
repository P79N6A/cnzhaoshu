<?php 
require 'checkhost2.php';
require 'db3.php';

$qrcode = $_POST['qrcode'];
$id = $_POST['id'];

$db = new db();

if($user['role'] != 6) exit;

$sql = 'select * from adopt_tree where qrcode=?';
$result1 = $db->prepare_query($sql,array($qrcode));
if(!$result1){
	$sql = 'update adopt_tree set qrcode=? where id=?';
	$result = $db->prepare_exec($sql,array($qrcode,$id));

	if ($result) {
		$return['return_code'] = '200';
		$return['return_msg'] = '修改成功';
	} else {
		$return['return_code'] = '400';
		$return['return_msg'] = '修改失败';
	}
}else{
	$return['return_code'] = '400';
	$return['return_msg'] = '该二维码已经被占用，请使用其他二维码';
}

echo json_encode($return);
unset($db);