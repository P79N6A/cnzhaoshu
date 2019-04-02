<?php 

require 'db.php';

$qrcode = $_POST['qrcode'];
$id = $_POST['id'];

$db = new db();

$sql = 'update adopt_tree set qrcode=? where id=?';
$result = $db->prepare_exec($sql,array($qrcode,$id));

if ($result) {
	$return['return_code'] = '200';
	$return['return_msg'] = '修改成功';
} else {
	$return['return_code'] = '400';
	$return['return_msg'] = '修改失败';
}

echo json_encode($return);
unset($db);