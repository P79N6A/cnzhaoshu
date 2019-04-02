<?php
require 'checkhost.php';
require 'db2.php';
require './record/basic.php';


$mediaId = $_POST['mediaId'];
$userid = $_POST['userid'];
$map_order_id = $_POST['map_order_id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$type = $_POST['type'];
$active = $_POST['active'];
$gps=$_POST['gps'];


$filename = basic::randChar(3).basic::getMillisecond();
$originalfilename = "../photos/o/$filename.jpg";
$smallfilename = "../photos/m/$filename.jpg";


if ($mediaId) {
	// 微信上传
	include '../wechat/wechat.class.php';
	$weObj = new Wechat();
	$media = $weObj->getMedia($mediaId);
	if (!$media) {
	    // 容错处理，微信多媒体下载接口会报错
	    $weObj->deleteAccessToken();
	    $media = $weObj->getMedia($mediaId);         
	}
	unset($weObj);
	file_put_contents($originalfilename, $media);
	$image0 = imagecreatefromstring($media);
	$image = basic::resizeImage($image0, 1280, 1280);  // 太大了先压缩 imagerotate不能处理
	imagedestroy($image0);
	unset($media);
	// 必要时旋转照片
	$exif = exif_read_data($originalfilename, 0, true);
	$orientation = $exif['IFD0']['Orientation'];
	if (!empty($orientation)) {
		$isRotate = false;
		switch($orientation) {
	        case 3:
	            $image = imagerotate($image, 180, 0);
	            $isRotate = true;
	            break;
	        case 6:
	            $image = imagerotate($image, -90, 0);
	            $isRotate = true;
	            break;
	        case 8:
	            $image = imagerotate($image, 90, 0);
	            $isRotate = true;
	            break;
	    }
	}
	if ($exif) {
		// if ($exif['EXIF']['DateTimeOriginal']) $phototime = preg_replace('/:/','-', $exif['EXIF']['DateTimeOriginal'],2);
	 //    else $phototime = date('Y-m-d H:i:s', time());
	    if ($exif['GPS'] &&  $exif['GPS']['GPSLatitude']) {
		    include_once './record/photogps2.php';
		    $gps = PhotoGPS::qqGps($exif['GPS']);
		}
	} else{
	    // $phototime = date('Y-m-d H:i:s', time());
		$gps = '';
	}
	if (!$gps && $_POST['gps']) $gps = $_POST['gps'];
	unset($exif);
	imagejpeg($image, $originalfilename, 80);
}else{
	// $phototime = $_POST['time'];
	// $phototime = date('Y-m-d H:i:s', $phototime); 
	$gps=$_POST['gps'];
	if (!$gps) {
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$latRef = $_POST['latRef'];
		$lngRef = $_POST['lngRef'];
		if ($lat && $lng) {
			include './record/photogps.php';
			$gps = PhotoGPS::qqGps($lat, $latRef, $lng, $lngRef);
		} else {
			$gps = '';
		}
	}
	$files = $_FILES['file'];
	$file=$files["tmp_name"];
	move_uploaded_file($file, $originalfilename);
	$image = imagecreatefromjpeg($originalfilename);
}


$image160 = basic::resizeImage($image, 160, 160);
imagejpeg($image160, $smallfilename, 80);

unset($image);
unset($image160);

$db = new db();



$sql = 'select a.*,b.state,b.map_id from (select * from maps_record where map_order_id=? and type = ? and userid=?) a right join (select state,id,map_id from maps_order where id=?) b on a.map_order_id = b.id';

$recordsinfo = $db->prepare_query($sql,array($map_order_id,$type,$userid,$map_order_id))[0];

$phototime = date('Y-m-d H:i:s', time()); 

if($recordsinfo['id']){
	$recordid = $recordsinfo['id'];
	$photo = $recordsinfo['photo'].';'.$filename;
	$gps = $recordsinfo['gps'].';'.$gps;

	$sql = 'update maps_record set photo=?,gps=?,time=? where map_order_id=? and type = ? and userid=?';
	$result = $db->prepare_exec($sql,array($photo,$gps,$phototime,$map_order_id,$type,$userid));

}else{
	$sql = 'insert into maps_record(userid,map_id,map_order_id,active,type,photo,gps,name,phone,time) values(?,?,?,?,?,?,?,?,?,?)';
	$recordid = $db->prepare_insert($sql,array($userid,$recordsinfo['map_id'],$map_order_id,$active,$type,$filename,$gps,$name,$phone,$phototime));
}

if($type > $recordsinfo['state']){
	$sql = 'update maps_order set state=?,time=? where id=?';
	$state = $db->prepare_exec($sql,array($type,$phototime,$map_order_id));
}

$result = $mediaId ? $_POST['index'].'-'.$recordid.'-'.$filename : $recordid.'-'.$filename;
unset($db);
echo $result;
