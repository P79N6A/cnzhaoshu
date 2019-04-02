<?php
/*
生成招标二维码
$img = QRcodeCreate::bid('2017033100111');
imagepng($img,'1.png');
*/
require 'qrcode.link.php';


class QRcodeCreate
{
	
  public static function projectqrcode($id) 
  {
      $logo = imagecreatefrompng('../img/qrlogo.png');
      $link = 'http://renyangshu.com/adopt_createproject.php?id='.$id; 

      $linkQrcode = new LinkQrcode();
      $qrcode = $linkQrcode->create($link, false, $logo); // 不输入名称，返回图片
      unset($linkQrcode);

      return $qrcode;
  }

  public static function treeqrcode($id) 
  {
      $logo = imagecreatefrompng('../img/qrlogo.png');
      $link = 'http://renyangshu.com/adopt_adopt.php?id='.$id; 

      $linkQrcode = new LinkQrcode();
      $qrcode = $linkQrcode->create($link, false, $logo); // 不输入名称，返回图片
      unset($linkQrcode);

      return $qrcode;
  }
  
}

