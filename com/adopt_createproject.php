<?php 

require 'db.php';
require 'qrcode.create.php';

$data = $_POST['data'];

$data = json_decode($data,true);

// 判断权限
// if($_COOKIE['user']['role'] !== 9) exit;

$db = new db();

$keyarray = array();
$valuearray = array();
$array = array();

$userkeyarray = array();
$uservaluearray = array();
$userarray = array();
foreach ($data as $key => $value) {
	if(($key != 'username') && ($key != 'phone')){
		array_push($keyarray,$key);
		array_push($valuearray,$data[$key]);
		array_push($array,'?');
	}else{
		array_push($userkeyarray,$key);
		array_push($uservaluearray,$data[$key]);
		array_push($userarray,'?');
	}	
}

// 查看此手机号的用户
$sql = 'select * from adopt_user where phone=?';
$result1 = $db->prepare_query($sql,array($data['phone']));
// 如果没有新增此用户
if(!$result1){
	$sql = 'insert into adopt_user('.join(',',$userkeyarray).') value('.join(',',$userarray).')';
	$result1 = $db->prepare_insert($sql,$uservaluearray);
	$userid = $result1;
	array_push($keyarray,'userid');
	array_push($valuearray,$result1);
	array_push($array,'?');
}else{
	$userid = $result1[0]['id'];
	array_push($keyarray,'userid');
	array_push($valuearray,$result1[0]['id']);
	array_push($array,'?');
}


$data['create_time'] =  time();

array_push($keyarray,'create_time');
array_push($valuearray,$data['create_time']);
array_push($array,'?');

$qrcodeid = time().$userid;
$qrcode = QRcodeCreate::projectqrcode($qrcodeid);
imagejpeg($qrcode, '../projectimage/'.$qrcodeid.'.jpg');

$data['qrcode'] =  $qrcodeid;

array_push($keyarray,'qrcode');
array_push($valuearray,$qrcodeid);
array_push($array,'?');


$sql = 'insert into adopt_project ('.join(',',$keyarray).') value('.join(',',$array).')';
$result3 = $db->prepare_insert($sql,$valuearray);

$data['id'] =  $result3;

$sql = "insert into adopt_treeprice (project_id,name,type,price) value(?,'乔木',1,75),(?,'灌木',2,30)";
$result4 = $db->prepare_insert($sql,array($result1,$result1));

if ($result1 && $result3 && $result4) {
	$return['return_code'] = '200';
	$return['return_msg'] = '添加成功';
	$return['return_data'][0] = $data;
} else {
	$return['return_code'] = '400';
	$return['return_msg'] = '添加失败';
}

imagedestroy($qrcode);

echo json_encode($return);
unset($db);