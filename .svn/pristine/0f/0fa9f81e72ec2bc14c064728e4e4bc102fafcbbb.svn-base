<?php 

require 'db2.php';
require 'qrcode.create.php';

$data = $_POST['data'];
$treeid = $_POST['treeid'];
$userid = $_POST['userid'];
$treeuserid = $_POST['treeuserid'];
$mapid = $_POST['mapid'];
$unit = $_POST['unit'];
$qrcodeid = get_total_millisecond();

if(!$unit) $unit = '株';

$data = json_decode($data,true);
$db = new db();


if($treeid){
	$sql = 'insert into map_order(userid,treeuserid,mapid,tree_id,number,qxqrcode) values(?,?,?,?,?,?)';
	$result = $db->prepare_insert($sql,array($userid,$treeuserid,$mapid,$treeid,$data['number'],$qrcodeid));

	ceateqrcode($qrcodeid);
}else{
	$sql = 'insert into map_tree(mapid,name,attribute,unit) values(?,?,?,?)';
	$result = $db->prepare_insert($sql,array($mapid,$data['name'],$data['attribute'],$unit));

	if($userid != $treeuserid){
		$sql = 'insert into map_order(userid,treeuserid,mapid,tree_id,number,qxqrcode) values(?,?,?,?,?,?)';
		$result = $db->prepare_insert($sql,array($userid,$treeuserid,$mapid,$result,$data['number'],$qrcodeid));

		ceateqrcode($qrcodeid);
	}
}

function ceateqrcode($qrcodeid){
	$qrcode = QRcodeCreate::maporderqxqrcode($qrcodeid);
	$filename = '../maporderqxqrcode/'.$qrcodeid.'.png';
	imagepng($qrcode, $filename);
}

function get_total_millisecond(){  
	$date = date('YmdHis',time());
    $time = explode (" ", microtime () );   
    $time = 100000 + (int)($time [0] * 100000);
    return ($date . $time); 
}

echo $result;
unset($db);
