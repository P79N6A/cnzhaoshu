<?php

// 生成招标二维码
// $img = QRcodeCreate::bid('2017033100111');
// imagepng($img,'1.png');

require 'qrcode.link.php';


class QRcodeCreate
{
	public static function bid($id) 
	{
  		$logo = imagecreatefrompng('caiye.png');
      imagepng($logo, '2.png');
      imagejpeg($logo, '2.jpg', 80);

  		// $logo = imagecreatefromjpeg('caiye.jpg');
  		$link = 'http://www.cnzhaoshu.com/2.php?ID='.$id;


  		$linkQrcode = new LinkQrcode();
      // $qrcode = $linkQrcode->create($link, false, $logo, $id); // 不输入名称，返回图片
      $qrcode = $linkQrcode->create($link, '1.png', $logo, $id); // 不输入名称，返回图片
  		unset($linkQrcode);

  		return $qrcode;
	}
}

// for ($i=3106000000001; $i < 3106000000011; $i++) { 
$i=3106000000001;
	$img = QRcodeCreate::bid($i);

	// imagepng($img,$i.'.png');
	// imagedestroy($img);
// }



