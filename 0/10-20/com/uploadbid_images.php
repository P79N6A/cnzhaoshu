<?php 
require 'checkhost.php';
require 'db2.php';
require 'basic.php';
require '../wechat/wechat.class.php';

$id = $_POST['id'];
$userid = $_POST['userid'];
$orderid = $_POST['orderid'];
$weObj = new Wechat();
// 从微信服务器拉取图片
$mediaId = $_POST['mediaId'];
$media = $weObj->getMedia($mediaId);
if (!$media) {
    $weObj->deleteAccessToken();
    $media = $weObj->getMedia($mediaId);         
}
unset($weObj);
$filename = basic::randChar(3).basic::getMillisecond();
$originalfilename = "../tenderphoto/o/$filename.jpg";
$smallfilename = "../tenderphoto/m/$filename.jpg";
file_put_contents($originalfilename, $media);
$image0 = imagecreatefromstring($media);
$image = basic::resizeImage($image0, 1280, 1280);  // 太大了先压缩 imagerotate不能处理
imagedestroy($image0);
unset($media);
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
imagedestroy($image);
imagedestroy($image160);

$db = new db();
$sql = 'select * from bid_order where id=? and userid=? and orderid=?';
$result1 = $db->prepare_query($sql,array($id,$userid,$orderid));

if($result1){
    if($result1[0]['image']){
        $images = $result1[0]['image'].','.$filename;
    }else{
        $images = $filename;
    }
    if(($result1[0]['state'] == 0) || ($result1[0]['state'] == 1)){
        $sql = 'update bid_order set image=? where id=? and userid=? and orderid=?';
        $result3 = $db->prepare_exec($sql,array($images,$id,$userid,$orderid));
        if($result3){
            echo $_POST['index'].'-'.$filename;
        }
    }
}else{
    $sql = 'insert into bid_order(userid,orderid,id,image) values(?,?,?,?)';
    $result2 = $db->prepare_exec($sql,array($userid,$orderid,$id,$filename));
    if($result2){
        echo $_POST['index'].'-'.$filename;
    }
}
unset($db);