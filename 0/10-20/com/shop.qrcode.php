<?php
/**
* 创建链接二维码
*/
class ShopQrcode
{
  private $QrSize = 430; 
  private $LogoSize = 100; 

  public function __construct() 
  {
    include_once '../phpqrcode/phpqrcode.php'; 
  }

  private function draw_roundrectangle($img, $x1, $y1, $x2, $y2, $radius, $color,$filled=1) {
	if ($filled==1){
	    imagefilledrectangle($img, $x1+$radius, $y1, $x2-$radius, $y2, $color);
	    imagefilledrectangle($img, $x1, $y1+$radius, $x1+$radius-1, $y2-$radius, $color);
	    imagefilledrectangle($img, $x2-$radius+1, $y1+$radius, $x2, $y2-$radius, $color);

	    imagefilledarc($img,$x1+$radius, $y1+$radius, $radius*2, $radius*2, 180 , 270, $color, IMG_ARC_PIE);
	    imagefilledarc($img,$x2-$radius, $y1+$radius, $radius*2, $radius*2, 270 , 360, $color, IMG_ARC_PIE);
	    imagefilledarc($img,$x1+$radius, $y2-$radius, $radius*2, $radius*2, 90 , 180, $color, IMG_ARC_PIE);
	    imagefilledarc($img,$x2-$radius, $y2-$radius, $radius*2, $radius*2, 360 , 90, $color, IMG_ARC_PIE);
	}else{
	    imageline($img, $x1+$radius, $y1, $x2-$radius, $y1, $color);
	    imageline($img, $x1+$radius, $y2, $x2-$radius, $y2, $color);
	    imageline($img, $x1, $y1+$radius, $x1, $y2-$radius, $color);
	    imageline($img, $x2, $y1+$radius, $x2, $y2-$radius, $color);

	    imagearc($img,$x1+$radius, $y1+$radius, $radius*2, $radius*2, 180 , 270, $color);
	    imagearc($img,$x2-$radius, $y1+$radius, $radius*2, $radius*2, 270 , 360, $color);
	    imagearc($img,$x1+$radius, $y2-$radius, $radius*2, $radius*2, 90 , 180, $color);
	    imagearc($img,$x2-$radius, $y2-$radius, $radius*2, $radius*2, 360 , 90, $color);
	}                
  }

  public function create($shopid) 
  {
      $data = 'http://www.cnzhaoshu.com/shop.php?userid='.$shopid;
      $filename = '../shop/qrcode/'.$shopid.'.jpg';

      // 纠错级别：L、M、Q、H 
      $errorCorrectionLevel = 'M';  
      // 点的大小：1到10 
      $matrixPointSize = 16;  
      // 生成二维码
      QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

      $image = imagecreatefrompng($filename);
      $width = imagesx($image);
      $height = imagesy($image);      
      $size = $this->QrSize;

      // 调整为 标注尺寸430*430
      $img = imagecreatetruecolor($size, $size);
      imagecopyresampled($img, $image, 0, 0, 0, 0, $size, $size, $width, $height);
      imagedestroy($image);

      // 加上头像
      $filelogo = $_SERVER['DOCUMENT_ROOT'].'/headimg/0/'.$shopid.'.jpg';
      if (file_exists($filelogo) && filesize($filelogo)>100) {
      	$logosize = $this->LogoSize;
      	$logo = imagecreatefromjpeg($filelogo);   
		$logo_width = imagesx($logo);//logo图片宽度   
		$img_width = imagesx($img);//二维码图片宽度   
      	

		$xy = ($img_width - $logosize) / 2;   // logo 居中布局的起始坐标
		$color = imagecolorallocate($img,204,204,204);//创建一个颜色，以供使用

		//重新组合图片并调整大小   
		imagecopyresampled($img, $logo, $xy, $xy, 0, 0, $logosize, $logosize, $logo_width, $logo_width);  
		//画边框 
		imagerectangle($img, $xy, $xy, $xy+$logosize-1, $xy+$logosize-1, $color);
 
      }

      imagepng($img, $filename);
      imagedestroy($img);
      imagedestroy($logo);
  }

}
