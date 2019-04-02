<?php 
require 'db.php';
require 'basic.php';
require '../wechat/wechat.class.php';


$count = $_POST['count'];
$mark = $_POST['mark'];
$id = $_POST['id'];
$project_id = $_POST['projectid'];
$tree_name = $_POST['tree_name'];
$price = $_POST['price'];
$qrcode = $_POST['qrcode'];

$mediaId = $_POST['mediaId'];

if($mediaId){
	$weObj = new Wechat();
	// 从微信服务器拉取图片
	$media = $weObj->getMedia($mediaId);
	if (!$media) {
	    // 容错处理，微信多媒体下载接口会报错
	    $weObj->deleteAccessToken();
	    $media = $weObj->getMedia($mediaId);         
	}

	$filename = time().rand(100000,999999).'.jpg';

	$originalfilename = "../photos/o/$filename";
	$smallfilename = "../photos/m/$filename";

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

	unset($exif);

	imagejpeg($image, $originalfilename, 80);
	$image160 = basic::resizeImage($image, 160, 160);
	imagejpeg($image160, $smallfilename, 80);
	imagedestroy($image160);
	imagedestroy($image);

}


$db = new db();

if ($gps) {
	if(!$id){
		$sql = 'insert into adopt_tree(project_id,qrcode,tree_name,count,price,image,gps,mark,create_time) value(?,?,?,?,?,?,?,?,?)';
		$result = $db->prepare_insert($sql,array($project_id,$qrcode,$tree_name,$count,$price,$filename,$gps,$mark,time()));
	}else{
		if($mediaId){
			$sql = 'update adopt_tree set count=?,mark=?,gps=?,image=?,price=?,tree_name=? where id=?';
			$result = $db->prepare_exec($sql,array($count,$mark,$gps,$filename,$price,$tree_name,$id));
		}else{
			$sql = 'update adopt_tree set count=?,mark=?,tree_name=?,price=? where id=?';
			$result = $db->prepare_exec($sql,array($count,$mark,$tree_name,$price,$id));
		}
	}

	if($result){
		$return['return_code'] = '200';
		$return['return_msg'] = '添加成功';
	}else{
		$return['return_code'] = '400';
		$return['return_msg'] = '添加失败';
	}
}else{
	$return['return_code'] = '201';
	$return['return_msg'] = '请上传带有GPS的原图片！';
}

echo json_encode($return);
unset($db);