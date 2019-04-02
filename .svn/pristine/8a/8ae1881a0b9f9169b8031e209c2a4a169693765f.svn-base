<?php
// require '../checkhost.php'; // 来路域名验证
require '../db.php';
require 'basic.php';
require 'record.php';

$phototime = $_POST['time'];
$userid = $_POST['userid'];
$mapid = $_POST['mapid'];
$maporderid = $_POST['maporderid'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$type = $_POST['type'];
$active = $_POST['active'];
$gps=$_POST['gps'];


$filename = basic::randChar(3).$phototime;
$originalfilename = "../../photos/o/$filename.jpg";
$smallfilename = "../../photos/m/$filename.jpg";

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
		include 'photogps.php';
		$gps = PhotoGPS::qqGps($lat, $latRef, $lng, $lngRef);
	} else {
		$gps = '';
	}
}


if ($gps) {
	$gps = explode(',', $gps);
	$x = $gps[0];
	$y = $gps[1];
}

$phototime = date('Y-m-d H:i:s', $phototime); 

// 同一个对象，同一个类型，一个监管
$record = record::search(array('maporderid'=>$maporderid, 'type'=>$type));

if ($record) {
	$record = $record[0];
	$recordid = $record['id'];

	$values = "name='$name', phone='$phone', photo=concat(photo,';$filename'), time='$phototime'";
    if ($x && $y) $values .= ",x=$x,y=$y";

	record::update($values, $record['id']);
} else {
	$values = array(	'userid'=>$userid, 
									'mapid'=>$mapid, 
									'maporderid'=>$maporderid, 
									'active'=>$active, 
									'type'=>$type, 
									'photo'=>$filename, 
									'x'=>$x, 
									'y'=>$y, 
									'name'=>$name, 
									'phone'=>$phone, 
									'time'=>$phototime );

	$recordid = record::insert($values);
}

echo $recordid.'-'.$filename;

$db = new db();
$db->prepare_exec('update map_order set state=? where id=?', array($type, $maporderid));
unset($db);

