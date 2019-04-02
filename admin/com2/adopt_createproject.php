<?php 
require 'checkhost2.php';
require 'db3.php';
require 'qrcode.create.php';

$data = $_POST['data'];
$data = json_decode($data,true);

// 判断权限
$user = json_decode($_COOKIE['user'],true);
if($user['role'] != 8) exit;


$db = new db();

$keyarray = array();
$valuearray = array();
$array = array();

foreach ($data as $key => $value) {
	array_push($keyarray,$key);
	array_push($valuearray,$data[$key]);
	array_push($array,'?');
}


$data['create_time'] =  time();

array_push($keyarray,'create_time');
array_push($valuearray,$data['create_time']);
array_push($array,'?');

$qrcodeid = time().$userid;
$qrcode = QRcodeCreate::projectqrcode($qrcodeid);
imagejpeg($qrcode, '../projectimages/'.$qrcodeid.'.jpg');

$data['qrcode'] =  $qrcodeid;

array_push($keyarray,'qrcode');
array_push($valuearray,$qrcodeid);
array_push($array,'?');

$sql = 'select * from adopt_project where phone=?';
$result = $db->prepare_query($sql,array($data['phone']));
if(!$result){

	$sql = 'insert into adopt_project ('.join(',',$keyarray).') value('.join(',',$array).')';
	$result3 = $db->prepare_insert($sql,$valuearray);

	$data['id'] =  $result3;

	$sql = "insert into adopt_treeprice (project_id,name,type,price) value(?,'乔木',1,75),(?,'灌木',2,30)";
	$result4 = $db->prepare_insert($sql,array($result3,$result3));
	
}

if ($result3 && $result4) {
	$return['return_code'] = '200';
	$return['return_msg'] = '添加成功';
	$return['return_data'][0] = $data;
} else {
	$return['return_code'] = '400';
	$return['return_msg'] = '添加失败-该手机号已绑定其他项目';
}

imagedestroy($qrcode);

echo json_encode($return);
unset($db);