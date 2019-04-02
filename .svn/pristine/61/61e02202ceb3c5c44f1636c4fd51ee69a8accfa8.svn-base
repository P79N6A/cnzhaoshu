<?php

// 生成树牌二维码
require 'checkhost.php'; checkhost();

// function http_get($url){
//     $oCurl = curl_init();
//     if(stripos($url,"https://")!==FALSE){
//         curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
//         curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
//         curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
//     }
//     curl_setopt($oCurl, CURLOPT_URL, $url);
//     curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
//     $sContent = curl_exec($oCurl);
//     $aStatus = curl_getinfo($oCurl);
//     curl_close($oCurl);

//     // echo $aStatus["content_type"];
//     if(intval($aStatus["http_code"])==200){
//         return $sContent;
//     }else{
//         return false;
//     }
// }

// $id = $_REQUEST["id"];

// $qr_image = http_get("http://qr.liantu.com/api.php?w=500&logo=http://cnzhaoshu.com/img/logo0.jpg&text=http://cnzhaoshu.com/2.php?ID=$id");
require('../phpqrcode/phpqrcode.php'); 

$logo = imagecreatefromjpeg("../img/logo0.jpg");   

for ($i=18000; $i < 20101; $i++) { 
	$id = "11010100$i";

	// 二维码数据 

	$data = "http://cnzhaoshu.com/2.php?ID=$id"; 
	// 生成的文件名 
	$filename = "../qrcode/$id.png"; 

	// 纠错级别：L、M、Q、H 
	$errorCorrectionLevel = 'M';  
	// 点的大小：1到10 
	$matrixPointSize = 16;  
	QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

	// $src_image = imagecreatefromstring($qr_image);

	$QR = imagecreatefrompng($filename);
	$QR_width = imagesx($QR);//二维码图片宽度   
	$QR_height = imagesy($QR);//二维码图片高度   
	$logo_width = imagesx($logo);//logo图片宽度   
	$logo_height = imagesy($logo);//logo图片高度   
	$logo_qr_width = $QR_width / 5;   
	$scale = $logo_width/$logo_qr_width;   
	$logo_qr_height = $logo_height/$scale;   
	$from_width = ($QR_width - $logo_qr_width) / 2;   
	//重新组合图片并调整大小   
	imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,   
	$logo_qr_height, $logo_width, $logo_height);   



	// $dst_image = imagecreatefrompng("../img/bg.png");
	$dst_image = imagecreatetruecolor($QR_width,$QR_height+30);
	$white = imagecolorallocate($dst_image, 255, 255, 255); //设置画布的背景为白色
	imagefill($dst_image, 0, 0, $white);

	imagecopyresampled($dst_image, $QR, 0,0, 0,0, $QR_width,$QR_height, $QR_width,$QR_height); 

	$fontSize = 32;
	$fontFile = '../font/simhei.ttf'; //字体文件
	$str = "ID $id";

	$rect = imagettfbbox($fontSize,0,$fontFile,$str); 
	$w = abs($rect[2]-$rect[6]+10); 
	$h = 60;// abs($rect[3]-$rect[7]+2);

	$str_image = imagecreatetruecolor($w, $h);
	$bg = imagecolorallocate($str_image, 255, 255, 255); //设置画布的背景为白色
	$black = imagecolorallocate($str_image, 0, 0, 0); //设置一个颜色变量为黑色

	imagettftext($dst_image,$fontSize,0,($QR_width-$w)/2,$QR_height+16,$black,$fontFile,$str); 


	imagepng($dst_image, "../qrcode/$id.png");
	imagedestroy($dst_image);
	imagedestroy($QR);

	file_put_contents('../qrcode/qrcode.txt', "http://cnzhaoshu.com/2.php?ID=$id,$id"."\n",FILE_APPEND);
}
echo "ok";
// require('basic.php');

// $result = basic::saveFile("../qrcode/$id.png", $qrImage); 
// if ($result) echo "ok";
// else echo "error";

?>