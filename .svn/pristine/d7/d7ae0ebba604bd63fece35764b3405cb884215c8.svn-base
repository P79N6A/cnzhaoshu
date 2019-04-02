<?php
// require 'checkhost.php'; // 来路域名验证
require 'checkhost.php';
require 'basic.php';
require 'db.php';
require '../wechat/wechat.class.php';
$myfile = fopen("./mapimage.log", "a+");
fwrite($myfile, $_POST['userid']."***");
fwrite($myfile, $_POST['mediaId']."***");
$weObj = new Wechat();

loger(' '.$_POST['userid'].','.$_POST['mediaId']);


// 从微信服务器拉取图片
$mediaId = $_POST['mediaId'];

$media = $weObj->getMedia($mediaId);
if (!$media) {
    loger('error-media:'.$_POST['userid'].','.$_POST['mediaId']);

    // 容错处理，微信多媒体下载接口会报错
    $weObj->deleteAccessToken();
    $media = $weObj->getMedia($mediaId);         
}

if (!$media)
    loger('error-media3:'.$_POST['userid'].','.$_POST['mediaId']);

fwrite($myfile, $media."***");

// // 保存图片，提取信息

// // 生成临时文件名,oM-qJjr0UqA7fwo7emRg1LxDQMQ8,o1nQfs9xfvqFP-3Ed2ItFkEcO5mw
// $filename = basic::randChar(3).basic::getMillisecond();
// $originalfilename = "../img/$filename.jpg";
// $smallfilename = "../img/$filename.jpg";

// file_put_contents($originalfilename, $media);

// $image0 = imagecreatefromstring($media);
// $image = basic::resizeImage($image0, 1280, 1280);  // 太大了先压缩 imagerotate不能处理
// imagedestroy($image0);
// unset($media);

// // 必要时旋转照片
// $exif = exif_read_data($originalfilename, 0, true);

// $orientation = $exif['IFD0']['Orientation'];
// if (!empty($orientation)) {
//     $isRotate = false;
//     switch($orientation) {
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
//     if ($exif['EXIF']['DateTimeOriginal']) $phototime = preg_replace('/:/','-', $exif['EXIF']['DateTimeOriginal'],2);
//     else $phototime = date('Y-m-d H:i:s', time());

//     if ($exif['GPS'] &&  $exif['GPS']['GPSLatitude']) {
//         include_once 'photogps2.php';
//         $gps = PhotoGPS::qqGps($exif['GPS']);
//     }
// } else{
//     $phototime = date('Y-m-d H:i:s', time());
//     $gps = '';
// }

// if (!$gps && $_POST['gps']) $gps = $_POST['gps'];

// echo "gps_wx: ".$_POST['gps']."\n";
// echo "gps: $gps\n";
// echo "phototime: $phototime\n";
// echo $filename;


fclose($myfile); 
exit;

// unset($exif);

// // $image1280 = basic::resizeImage($image, 1280, 1280);
// imagejpeg($image, $originalfilename, 80);


// $image160 = basic::resizeImage($image, 160, 160);
// imagejpeg($image160, $smallfilename, 80);

// imagedestroy($image);
// // imagedestroy($image1280);
// imagedestroy($image160);

// $mapid = $_POST['mapid'];
// $userid = $_POST['userid'];
// $state = $_POST['state'];

// $db = new db();
//     switch ($state) {
//         case 1:
//             $str = 'hs_gps=?,hs_img=?,hs_time=?';
//             break;
//         case 2:
//             $str = 'qs_gps=?,qs_img=?,qs_time=?';
//             break;
//         case 3:
//             $str = 'zc_gps=?,zc_img=?,zc_time=?';
//             break;
//         default:
//             break;
//     }
// $sql = 'update map_order set '.$str.' where id=?';

// $result = $db->prepare_exec($sql,array($gps,$filename,$phototime,$mapid));

