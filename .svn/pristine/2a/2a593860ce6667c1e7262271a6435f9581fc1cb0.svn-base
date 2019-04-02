<?php
require '../checkhost.php'; // 来路域名验证
require '../db.php';
require 'basic.php';
require 'record.php';

// file_put_contents('r2.txt', json_encode($_POST));
// 从微信服务器拉取图片
$mediaId = $_POST['mediaId'];
$userid = $_POST['userid'];
$mapid = $_POST['mapid'];
$maporderid = $_POST['maporderid'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$type = $_POST['type'];
$active = $_POST['active'];

$filename = basic::randChar(3).basic::getMillisecond();
$originalfilename = "../../photos/o/$filename.jpg";
$smallfilename = "../../photos/m/$filename.jpg";

if ($mediaId) {
	// 微信上传
	include '../../wechat/wechat.class.php';

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


	// gps
	if ($exif) {
		if ($exif['EXIF']['DateTimeOriginal']) $phototime = preg_replace('/:/','-', $exif['EXIF']['DateTimeOriginal'],2);
	    else $phototime = date('Y-m-d H:i:s', time());

	    if ($exif['GPS'] &&  $exif['GPS']['GPSLatitude']) {
		    include_once 'photogps2.php';
		    $gps = PhotoGPS::qqGps($exif['GPS']);
		}
	} else{
	    $phototime = date('Y-m-d H:i:s', time());
		$gps = '';
	}
	if (!$gps && $_POST['gps']) $gps = $_POST['gps'];
// file_put_contents('r2.txt', json_encode($exif));

	unset($exif);

	imagejpeg($image, $originalfilename, 80);
} else {
	$phototime = $_POST['time'];
	$phototime = date('Y-m-d H:i:s', $phototime); 

	$gps=$_POST['gps'];
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

	$files = $_FILES['file'];
	$file=$files["tmp_name"];
	move_uploaded_file($file, $originalfilename);

	$image = imagecreatefromjpeg($originalfilename);
}

// 保存小图
$image160 = basic::resizeImage($image, 160, 160);
imagejpeg($image160, $smallfilename, 80);

imagedestroy($image);
imagedestroy($image160);

// 识别二维码
$imageQrcode = new ZBarCodeImage($originalfilename);	// 新建一个图像对象
$scanner = new ZBarCodeScanner(); // 创建一个二维码识别器  
$barcode = $scanner->scan($imageQrcode);//识别图像  

if (!empty($barcode)){
	$qrcode = $barcode[0]['data'];
	$params = split('ID=', $qrcode);
	if (count($params)==2 && is_numeric($params[1])) {
		$qrcodeid = $params[1];
	}
}		

imagedestroy($imageQrcode);


// GPS
if ($gps) {
	$gps = explode(',', $gps);
	$x = $gps[0];
	$y = $gps[1];
}

// 数据库插入二维码
$db = new db();

if ($qrcodeid) {
	// 检查二维码是否已经使用
	$qrcode = $db->query('select id from map_tree where find_in_set(\''.$qrcodeid.'\', qrcode)');
	if ($qrcode) {
		$result = 'q'.'-'.$_POST['index'];
	} else {
		$treeid = $_POST['treeid'];
		$tree = $db->prepare_query('select qrcode from map_tree where id=?', array($treeid));
	    $qrcode = $tree[0]['qrcode'];
	    
	    $value = $qrcode ? "qrcode=concat(qrcode,',$qrcodeid'), photo=concat(photo,',$filename')" : "qrcode='$qrcodeid', photo='$filename'";
	    $db->prepare_exec('update map_tree set '.$value.' where id=?', array($treeid));
	}
}

if ($result) {
	// 二维码重复删图，不入库
	unlink($originalfilename);
	unlink($smallfilename);
} else {
	$db->prepare_exec('update map_order set state=? where id=?', array($type, $maporderid));

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

	$result = $mediaId ? $_POST['index'].'-'.$recordid.'-'.$filename : $recordid.'-'.$filename;
}	

unset($db);

echo $result;
