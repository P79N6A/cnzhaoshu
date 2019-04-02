<?php


require 'qrcode.create2.php';



		$font="../font/simhei.ttf";

		for ($i=3106400000001; $i < 3106400001001; $i++) { 
			$image = '../999/4.jpg';
			$image = imagecreatefromjpeg($image);

			$content=$i;

			$color=imagecolorallocatealpha($image,255,255,255,0);
			imagettftext($image, 40, 0, 520, 573, $color, $font, $content);

			$qrcode = QRcodeCreate::bid($i);

			imagecopyresampled($image, $qrcode, 1050, 363, 30, 30, 222,222,370,370);

			imagejpeg($image, '../mp/4/'.$i.'.jpg');
			imagedestroy($image);
		}





		// header('Content-Type: image/jpeg');
		// imagejpeg($image,null,100);

