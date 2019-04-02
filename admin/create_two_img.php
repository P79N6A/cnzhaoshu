<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/10/31
 * Time: 16:45
 * 生成二维码接口
 */
include "../phpqrcode/phpqrcode.php";

$value=isset($_POST['contents'])?$_POST['contents']:"";

function crsate_two_img($value){
	
    $errorCorrectionLevel = 'L';//容错级别
	
    $matrixPointSize = 6;//生成图片大小
	
    QRcode::png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);
	
//$logo = 'logo.png';//准备好的logo图片

    $QR = 'qrcode.png';//已经生成的原始二维码图
	
    $QR = imagecreatefromstring(file_get_contents($QR));
	
    $upload='./imgs/'.time();
	
    $filename=$upload.'helloweixin.png';
	
    $img=imagepng($QR, $filename);
	
    return $filename;
	
}

//生成二维码图片

echo crsate_two_img($value);