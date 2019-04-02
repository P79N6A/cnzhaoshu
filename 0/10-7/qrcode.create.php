<?php
/*
生成招标二维码
$img = QRcodeCreate::bid('2017033100111');
imagepng($img,'1.png');
*/
require 'qrcode.link.php';


class QRcodeCreate
{
	public static function bid($id) 
	{
  		$logo = imagecreatefrompng('../img/qrlogo.png');
  		$link = 'http://cnzhaoshu.com/qrcodeorder.php?id='.$id; 


  		$linkQrcode = new LinkQrcode();
  		$qrcode = $linkQrcode->create($link, false, $logo); // 不输入名称，返回图片
  		unset($linkQrcode);

  		return $qrcode;
	}

	public static function permission($id) 
	{
  		$logo = imagecreatefrompng('../img/qrlogo.png');
  		$link = 'http://cnzhaoshu.com/permission.php?id='.$id; 


  		$linkQrcode = new LinkQrcode();
  		$qrcode = $linkQrcode->create($link, false, $logo); // 不输入名称，返回图片
  		unset($linkQrcode);

  		return $qrcode;
	}
}

