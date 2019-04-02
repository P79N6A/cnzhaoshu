<?php
// require '../checkhost.php'; // 来路域名验证
require 'db.php';
require './record/basic.php';

$phototime = $_POST['time'];
$userid = $_POST['userid'];
$supervision_id = $_POST['supervision_id'];

$name = $_POST['name'];
$phone = $_POST['phone'];
$type = $_POST['type'];
$active = $_POST['active'];
$gps=$_POST['gps'];


$filename = basic::randChar(3).$phototime;
$originalfilename = "../photos/o/$filename.jpg";
$smallfilename = "../photos/m/$filename.jpg";

$files = $_FILES['file'];
$file=$files["tmp_name"];
move_uploaded_file($file, $originalfilename);

$image = imagecreatefromjpeg($originalfilename);
$image160 = basic::resizeImage($image, 160, 160);
imagejpeg($image160, $smallfilename, 80);

unset($image);
unset($image160);

if (!$gps) {
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$latRef = $_POST['latRef'];
	$lngRef = $_POST['lngRef'];

	if ($lat && $lng) {
		include './record/photogps.php';
		$gps = PhotoGPS::qqGps($lat, $latRef, $lng, $lngRef);
	} else {
		$gps = ';';
	}
}
$db = new db();

$sql = 'select * from map_records where supervision_id=? and type = ? and userid=?';

$result = $db->prepare_query($sql,array($supervision_id,$type,$userid))[0];

$phototime = date('Y-m-d H:i:s', $phototime); 

if($result){
	$recordid = $result['id'];
	$photo = $result['photo'].';'.$filename;
	$gps = $result['gps'].';'.$gps;

	$sql = 'update map_records set photo=?,gps=?,time=? where supervision_id=? and type = ? and userid=?';
	$result = $db->prepare_exec($sql,array($photo,$gps,$phototime,$supervision_id,$type,$userid));

}else{
	$sql = 'insert into map_records(userid,supervision_id,active,type,photo,gps,name,phone,time) values(?,?,?,?,?,?,?,?,?)';
	$recordid = $db->prepare_insert($sql,array($userid,$supervision_id,$active,$type,$filename,$gps,$name,$phone,$phototime));
}

unset($db);
echo $recordid.'-'.$filename;

