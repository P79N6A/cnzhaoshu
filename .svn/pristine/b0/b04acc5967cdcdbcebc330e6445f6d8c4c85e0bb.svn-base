<?php 


$image = imagecreatetruecolor(500,500);
$images = imagecolorallocatealpha($image, 0 , 0 , 0 , 127);
imagefill($image,0,0,$images);

$payimage = './11.png';
$payimage = imagecreatefrompng($payimage);


//重新组合图片并调整大小   
imagecopyresampled($image, $payimage, 0, 0, 400, 300, 500, 500, 360, 360);  
// $image = imagerotate($image, 315, 0);
header("Content-type:image/png");

ImagePng($image,'./01.png');
ImagePng($image);


 ?>