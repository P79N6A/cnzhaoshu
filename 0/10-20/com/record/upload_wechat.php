<?php
                    // {
                    //     type: uploadData.type,
                    //     work: uploadData.active,
                    //     name: uploadData.name,
                    //     phone: uploadData.phone,
                    //     userid: user.userid,
                    //     mapid: mapid,
                    //     maporderid: maporderid,
                    //     gps: gps,
                    //     index: i  // 计数
                    // },

// require '../checkhost.php'; // 来路域名验证
require '../db.php';
require 'basic.php';
require 'record.php';
require '../../wechat/wechat.class.php';

file_put_contents('r2.txt', json_encode($_POST));

$weObj = new Wechat();

// 从微信服务器拉取图片
$mediaId = $_POST['mediaId'];

$media = $weObj->getMedia($mediaId);
if (!$media) {
    // loger('error-media:'.$_POST['userid'].','.$_POST['mediaId']);

    // 容错处理，微信多媒体下载接口会报错
    $weObj->deleteAccessToken();
    $media = $weObj->getMedia($mediaId);         
}

unset($weObj);

// if (!$media)
//     loger('error-media3:'.$_POST['userid'].','.$_POST['mediaId']);


// 保存图片，提取信息

// 生成临时文件名,oM-qJjr0UqA7fwo7emRg1LxDQMQ8,o1nQfs9xfvqFP-3Ed2ItFkEcO5mw
$filename = basic::randChar(3).basic::getMillisecond();
$originalfilename = "../../photos/o/$filename.jpg";
$smallfilename = "../../photos/m/$filename.jpg";


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

if (!$gps && $_POST['gps']) $gps = $_POST['gps'];

if ($gps) {
    $gps = explode(',', $gps);
    $x = $gps[0];
    $y = $gps[1];
}


imagejpeg($image, $originalfilename, 80);

$imageQrcode = new ZBarCodeImage($originalfilename);    // 新建一个图像对象
$scanner = new ZBarCodeScanner(); // 创建一个二维码识别器  
$barcode = $scanner->scan($imageQrcode);//识别图像  

if (!empty($barcode)){
    $qrcode = $barcode[0]['data'];
    $params = split('ID=', $qrcode);
    if (count($params)==2 && is_numeric($params[1])) {
        $qrcodeid = $params[1];
    }
}       

$image160 = basic::resizeImage($image, 160, 160);
imagejpeg($image160, $smallfilename, 80);

imagedestroy($imageQrcode);
imagedestroy($image);
imagedestroy($image160);



$userid = $_POST['userid'];
$mapid = $_POST['mapid'];
$maporderid = $_POST['maporderid'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$type = $_POST['type'];
$active = $_POST['active'];

// 同一个对象，同一个类型，一个监管
$record = record::search(array('maporderid'=>$maporderid, 'type'=>$type));

if ($record) {
    $record = $record[0];
    $recordid = $record['id'];

    $values = "name='$name', phone='$phone', photo=concat(photo,';$filename'), time='$phototime'";
    if ($x && $y) $values .= ",x=$x,y=$y";
    loger(json_encode($record));
    loger(json_encode($values));

    record::update($values, $record['id']);
} else {
    $values = array(    'userid'=>$userid, 
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

echo $_POST['index'].'-'.$recordid.'-'.$filename;

$db = new db();
$db->prepare_exec('update map_order set state=? where id=?', array($type, $maporderid));

// 数据库插入二维码
if ($qrcodeid) {
    $treeid = $_POST['treeid'];
    $tree = $db->prepare_query('select qrcode from map_tree where id=?', array($treeid));
    $qrcode = $tree[0]['qrcode'];
    
    $value = $qrcode ? "qrcode=concat(qrcode,';$qrcodeid')" : "qrcode='$qrcodeid'";
    file_put_contents('r.txt', json_encode($tree)."\n".$value."\n treeid".$treeid);

    $db->prepare_exec('update map_tree set '.$value.' where id=?', array($treeid));
}

unset($db);

function loger($content) 
{
    file_put_contents('r2.txt', date("Y-m-d h:i:s").$content."\n",FILE_APPEND);
}


