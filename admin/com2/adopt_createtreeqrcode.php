<?php 
require 'checkhost2.php';
require 'db3.php';
require 'qrcode.create.php';


// 判断权限
$user = json_decode($_COOKIE['user'],true);

if($user['role'] != 8) exit;
$db = new db();


$qrcodeid = $_POST['id'];
$qrcode = QRcodeCreate::treeqrcode($qrcodeid);
$result1 = imagejpeg($qrcode, '../treeimage/'.$qrcodeid.'.jpg');
$sql = "insert into adopt_treeqrcode(qrcode) value(?)";
$result = $db->prepare_insert($sql,array($qrcodeid));


imagedestroy($qrcode);
if($result && $result1){
	$return['return_code'] = '200';
	$return['return_msg'] = '修改成功';
	echo json_encode($return);
}
unset($db);