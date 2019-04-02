<?php

require 'db.php';
// require 'basic.php';
// require '../wechat/wechat.class.php';

// $weObj = new Wechat();

// // 从微信服务器拉取图片
// $mediaId = $_POST['mediaId'];
// $media = $weObj->getMedia($mediaId);
// if (!$media) {
//     // 容错处理，微信多媒体下载接口会报错
//     $weObj->deleteAccessToken();
//     $media = $weObj->getMedia($mediaId);         
// }
// unset($weObj);

// // 生成临时文件名
// $filename = microtime().rand(100,999);
// $originalfilename = "../photos/o/$filename.jpg";
// $smallfilename = "../photos/m/$filename.jpg";


// file_put_contents($originalfilename, $media);

// $image0 = imagecreatefromstring($media);
// $image = basic::resizeImage($image0, 1280, 1280);  // 太大了先压缩 imagerotate不能处理
// imagedestroy($image0);
// unset($media);

// // 必要时旋转照片
// $exif = exif_read_data($originalfilename, 0, true);

// $orientation = $exif['IFD0']['Orientation'];
// if (!empty($orientation)) {
// 	$isRotate = false;
// 	switch($orientation) {
//         case 3:
//             $image = imagerotate($image, 180, 0);
//             $isRotate = true;
//             break;
//         case 6:
//             $image = imagerotate($image, -90, 0);
//             $isRotate = true;
//             break;
//         case 8:
//             $image = imagerotate($image, 90, 0);
//             $isRotate = true;
//             break;
//     }
// }


// // gps
// if ($exif) {
// 	if ($exif['EXIF']['DateTimeOriginal']) $phototime = preg_replace('/:/','-', $exif['EXIF']['DateTimeOriginal'],2);
//     else $phototime = date('Y-m-d H:i:s', time());

//     if ($exif['GPS'] &&  $exif['GPS']['GPSLatitude']) {
// 	    include_once 'photogps2.php';
// 	    $gps = PhotoGPS::qqGps($exif['GPS']);
// 	}
// } else{
//     $phototime = date('Y-m-d H:i:s', time());
// 	$gps = '';
// }

// unset($exif);

// if (!$gps && $_POST['gps']) $gps = $_POST['gps'];

// if ($gps) {
//     $gps = explode(',', $gps);
//     $x = $gps[0];
//     $y = $gps[1];
// }

// imagejpeg($image, $originalfilename, 80);

// $image160 = basic::resizeImage($image, 160, 160);
// imagejpeg($image160, $smallfilename, 80);

// imagedestroy($image);
// imagedestroy($image160);



$qrcode = '123412121';
$gps = '123.1212,92.1221';
$filename = '1.jpg';

$db = new db();

$sql = 'insert into adopt_tree(qrcode,image,gps,create_time) value(?,?,?,?)';
$id = $db->prepare_insert($sql,array($qrcode,$filename,$gps,time()));

if($id){
    $result['return_code'] = 200;
    $result['return_msg'] = '图片上传成功';
    $result['id'] = $id;
    $result['image'] = $filename;
}else{
    $result['return_code'] = 400;
    $result['return_msg'] = '图片上传失败';
}

echo json_encode($result);



