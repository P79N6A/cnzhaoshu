<?php
require 'checkhost.php'; 
require 'wechat.importnews.php';
require 'db2.php';
require 'basic.php';


$url = $_GET['url'];
$shopid = $_GET['userid'];

$news = importnews($url);

if ($shopid && $news) {
  $db = new db();
  $sql = 'insert into shop_project(shopid, msg_title,msg_desc,msg_link) values(?,?,?,?)';
  $projectid = $db->prepare_insert( $sql, array($shopid, $news['msg_title'], $news['msg_desc'], $news['msg_link']) );
  unset($db);

  // // 保存图片
  
  $filename = '../shop/project/o/'.$projectid.'.jpg';
  $imgRawData = file_get_contents($news['msg_cdn_url']);
  file_put_contents($filename, $imgRawData);

  $image = imagecreatefromstring($imgRawData);
  unset($imgRawData);

  $image = basic::resizeImage($image, 960, 960);
  $image160 = basic::squareImage2($image, 160);
  $filename = '../shop/project/m/'.$projectid.'.jpg';
  imagejpeg($image160, $filename, 80);
  // $image960 = basic::squareImage($image);
  

  $width = imagesx($image);
  $height = imagesy($image);

  $height1 = 0.4*$width;

  $y = ($height1-$height)*0.6;

  // 重新取样
  $new_image = imagecreatetruecolor($width, $height1);
  imagecopyresampled($new_image, $image, 0, $y, 0, 0, $width, $height, $width, $height);

  $filename = '../shop/project/b/'.$projectid.'.jpg';
  imagejpeg($new_image, $filename, 80);



  imagedestroy($image);
  imagedestroy($new_image);
  imagedestroy($image160);

  // 生成微信公众号二维码
  $qrcode = file_get_contents('http://open.weixin.qq.com/qr/code/?username='.$news['user_name']);
  file_put_contents('../shop/qrcode/wx'.$shopid.'.jpg', $qrcode);
  unset($qrcode);


  $news['id'] = $projectid;

  echo json_encode($news);
}



?>