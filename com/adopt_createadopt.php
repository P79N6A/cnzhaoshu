<?php 
require 'db.php';
require 'basic.php';
require '../wechat/wechat.class.php';


$year = $_POST['year'];
$mark = $_POST['mark'];
$id = $_POST['id'];
$adopt_price = $_POST['adopt_price'];
$mediaId = $_POST['mediaId'];
$invoice = $_POST['invoice'];
$tree_id = $_POST['tree_id'];

// $mediaId = '041tyzouzqhqlet8hp-uaykHCB_Bppvq@Ayu_Cw6jIIaP1OILYF4XNEDGWHB';

// $user = $_COOKIE['user2'];
$user['userid'] = 1;

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

	imagejpeg($image, $originalfilename, 80);
	$image160 = basic::resizeImage($image, 160, 160);
	imagejpeg($image160, $smallfilename, 80);
	imagedestroy($image160);
	imagedestroy($image);
}

$db = new db();
if($adopt_price>200){
	$invoice_address = $invoice;
	$invoice = 1;
}
$time = time();

if(!$id){
	$expiration_time = $year*365*24*60*60+$time;

	// 创建新的认养记录
	$sql = 'insert into adopt_adopt(userid,tree_id,adopt_price,adopt_image,adopt_mark,expiration_time,adopt_time) value(?,?,?,?,?,?,?)';
	$result = $db->prepare_insert($sql,array($user['userid'],$tree_id,$adopt_price,$filename,$mark,$expiration_time,$time));
}else{
	$expiration_time = $year*365*24*60*60;
	// 修改认养时间备注及图片
	if($mediaId){
		$sql = 'update adopt_adopt set adopt_price=(?),adopt_image=?,adopt_mark=?,expiration_time+=? where id=?';
		$result = $db->prepare_exec($sql,array($adopt_price,$filename,$mark,$expiration_time,$id));
	}else{
		$sql = 'select * from adopt_adopt where id=?';
		$data = $db->prepare_query($sql,array($id))[0];
		// 修改之前的认养记录
		$sql = 'update adopt_adopt set adopt_price=?,adopt_mark=?,expiration_time=? where id=?';
		$result = $db->prepare_exec($sql,array($data['adopt_price']+$adopt_price,$mark,$data['expiration_time']+$expiration_time,$id));
	}
}

if($result){
	$sql = 'insert into adopt_order(number,invoice,invoice_address,money) value(?,?,?,?)';
	$result = $db->prepare_insert($sql,array($time.$user['userid'],$invoice,$invoice_address,$adopt_price));
	if($result){
		$return['return_code'] = '200';
		$return['return_msg'] = '添加成功';
		$return['return_data'] = ['id'=>$result];
	}
}else{
	$return['return_code'] = '400';
	$return['return_msg'] = '添加失败';
}

echo json_encode($return);
unset($db);