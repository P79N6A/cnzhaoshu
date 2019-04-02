<?php
/**
* 创建链接二维码
*/
class LinkQrcode
{
  private $size; //图片大小，方形
  private $fontsize; //图片大小，方形

  public function __construct($size=430, $fontsize=40) 
  {
    include_once '../phpqrcode/phpqrcode.php';
    include_once 'qrcode.image.php'; 

    $this->size = $size;
    $this->fontsize = $fontsize;
  }

  public function create($data, $filename, $logo, $label) 
  {
      // 纠错级别：L、M、Q、H 
      $errorCorrectionLevel = 'M';  
      // 点的大小：1到10 
      $matrixPointSize = 16;  

      // 生成二维码      
      // $image = QRcode::png($data, false,$errorCorrectionLevel, $matrixPointSize);
      $image = QRcode::png($data, $filename,$errorCorrectionLevel, $matrixPointSize);
      if ($filename) $image = imagecreatefrompng($filename);

      if ($logo) $image = QrcodeImage::logo($image, $logo);
      if ($label) $image = QrcodeImage::label($image, $label, $this->fontsize);


      // 调整尺寸
      $width = imagesx($image);
      $height = imagesy($image);      
      $size = $this->size;
      $img = imagecreatetruecolor($size, $size);
      imagecopyresampled($img, $image, 0, 0, 0, 0, $size, $size, $width, $height);
      imagedestroy($image);      

      // 有文件名保存文件，否则返回图片
      if ($filename) {
        imagepng($img, $filename);
        imagedestroy($img);
      } else {
        return $img;
      }
  }

}
