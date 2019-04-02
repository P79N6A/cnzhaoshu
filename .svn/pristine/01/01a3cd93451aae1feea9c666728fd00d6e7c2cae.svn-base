<?php 

class Createtenderimage
{
	public static $overwidth = false;
	public static $count = 0;

	public static function create($expiration_date,$userid,$useraddress,$showdata,$qrcode){
		
		$db = new db();
		$sql = 'select name from user where userid=?';
		$user = $db->prepare_query($sql, array($userid))[0];
		$name = $user['name'];
		unset($db);

		$image = imagecreatetruecolor(480,20000);
		$white = imagecolorallocate($image, 255,236,160);
		imagefill($image, 0, 0, $white);


		$font="../font/simhei.ttf";
		$content="苗木招标";
		$color=imagecolorallocatealpha($image,0,0,0,0);
		$colorred=imagecolorallocatealpha($image,141,10,0,0);
		imagettftext($image, 35, 0, 145, 70, $color, $font, $content);

		$linecolor=imagecolorallocatealpha($image,180,180,180,0);
		imagefilledrectangle ( $image, 15, 80, 465, 80, $linecolor);

		$payimage = '../img/666.png';
		$payimage = imagecreatefrompng($payimage);

		imagecopyresampled($image, $payimage, 280, 10, 0, 0, 191,179,381,358);

		$content='招标支付'.count($showdata).'元';
		imagettftext($image, 17, 325, 313, 70, $colorred, $font, $content);

		$content='截止日期：      ';
		imagettftext($image, 18, 0, 20, 110, $color, $font, $content);

		$content=$expiration_date;
		imagettftext($image, 16, 0, 150, 110, $color, $font, $content);

		$content='招标人：        ';
		imagettftext($image, 18, 0, 20, 140, $color, $font, $content);

		$content = self::autowrap(14, 0, $font, $name,310);
		imagettftext($image, 16, 0, 150, 140, $color, $font, $content);

		$height = 140;

		if(self::$overwidth){
			$height += self::$count*25;
			self::$overwidth = false;
		}

		if($useraddress){
			$height += 30;
			$content='用苗地：  ';
			imagettftext($image, 18, 0, 20, $height, $color, $font, $content);

			$content = self::autowrap(14, 0, $font, $useraddress,310);
			imagettftext($image, 16, 0, 150, $height, $color, $font, $content);

			if(self::$overwidth){
				$height += self::$count*25;
				self::$overwidth = false;
			}
		}

		$height += 15;
		imagecopyresampled($image, $qrcode, 150, $height, 0, 0, 200,200,430,430);

		$height += 230;

		$content="长按二维码投标";
		imagettftext($image, 15, 0, 320, $height, $color, $font, $content);

		$height += 15;

		imagefilledrectangle ( $image, 15, $height, 465, $height, $linecolor);

		for ($i=0; $i < count($showdata); $i++) { 
			$height += 25;

			$content= (1+$i).'.';
			imagettftext($image, 16, 0, 20, $height, $color, $font, $content);

			$content= $showdata[$i]['name'];
			imagettftext($image, 17, 0, 50, $height, $color, $font, $content);

			$content= $showdata[$i]['count'].'('.$showdata[$i]['unit'].')';
			imagettftext($image, 14, 0, 200, $height, $color, $font, $content);

			$height += 20;
			$content = self::autowrap(13, 0, $font, $showdata[$i]['attribute'],410);
			imagettftext($image, 13, 0, 50, $height, $color, $font, $content);
			if(self::$overwidth){
				$height += self::$count*20;
				self::$overwidth = false;
			}
			$height += 10;
			imagefilledrectangle ( $image, 15, $height, 465, $height, $linecolor);
		}

		$height += 20;
		$content="来自：找树网";
		imagettftext($image, 12, 0, 360, $height, $color, $font, $content);

		$height += 30;
		$images = imagecreatetruecolor(480,$height);
		$white = imagecolorallocate($image, 255,255,255);

		imagecopyresampled($images, $image, 0, 0, 0, 0, 480,$height,480,$height);
		return $images;
	}

	/**
	* 文字自动换行
	* @param [type] $fontsize [字体大小]
	* @param [type] $angle [角度]
	* @param [type] $fontface [字体名称]
	* @param [type] $string [字符串]
	* @param [type] $width [预设宽度]
	*/


	public static function autowrap($fontsize, $angle, $fontface, $string, $width) {
		$info = "";
		self::$count = 0;
		// 将字符串拆分成一个个单字 保存到数组 letter 中
		preg_match_all("/./u", $string, $arr);
		$letter = $arr[0];
		foreach ($letter as $l) {
		$teststr = $info." ".$l;
		$testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
		// 判断拼接后的字符串是否超过预设的宽度
		if (($testbox[2] > $width) && ($info !== "")) {
			$info .= PHP_EOL;
			self::$count += 1;
			self::$overwidth = true;
		}
			$info .= $l;
		}
		return $info;
	}

}


