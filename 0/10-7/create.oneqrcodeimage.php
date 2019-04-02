<?php

class Createoneimage{

	public static function create($orderid,$qrcodeid){

		$db = new db();

		$sql = 'select * from tree_order where orderid=?';
		$result = $db->prepare_query($sql,array($orderid));

		if($result && (count($result) == 1)){
			$sql = 'select a.userid,a.address,a.expiration_date,user.name username,user.phone userphone from (select userid,id,address,expiration_date from tree_order_index where id=?) a left join user on a.userid=user.userid';
			$userinfo = $db->prepare_query($sql,array($orderid))[0];
		}


		$image = '../ditu.png';
		$image = imagecreatefrompng($image);

		$font="../font/simhei.ttf";
		$content="苗 木 招 标";

		$color=imagecolorallocatealpha($image,0,0,0,0);
		$colorred=imagecolorallocatealpha($image,141,10,0,0);
		imagettftext($image, 100, 0, 200, 160, $color, $font, $content);


		$payimage = '../img/666.png';
		$payimage = imagecreatefrompng($payimage);

		imagecopyresampled($image, $payimage, 600, 20, 0, 0, 572,537,381,358);

		$content='招标已支付';
		imagettftext($image, 50, 325, 710, 200, $colorred, $font, $content);


		$content="名    称：";
		imagettftext($image, 40, 0, 230, 270, $color, $font, $content);


		$content=$result[0]['name'];
		imagettftext($image, 35, 0, 500, 270, $color, $font, $content);

		$content="数    量：";
		imagettftext($image, 40, 0, 230, 330, $color, $font, $content);

		$content=$result[0]['count'];
		imagettftext($image, 35, 0, 520, 330, $color, $font, $content);


		$linecolor=imagecolorallocatealpha($image,204,184,102,50);
		imagefilledrectangle ( $image, 230, 350, 900, 350, $linecolor);

		$attribute = ['trunk_diameter','ground_diameter','pot_diameter','age','plant_height','plant_height_cm','crown','crown_cm','branch_length','bough_length','branch_point_height','branch_number','bough_number','substrate'];

		$heights = 353;
		for ($i=0; $i < count($attribute); $i++) { 
			if($result[0][$attribute[$i]]){
				$heights += 65;
				$value = explode(',', $result[0][$attribute[$i]]);
				if($attribute[$i] == 'trunk_diameter'){
					$content="胸    径：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = $value[0].'-'.$value[1].'cm';
					}else{
						$str = $value[0].'cm';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'ground_diameter'){
					$content="地    径：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = $value[0].'-'.$value[1].'cm';
					}else{
						$str = $value[0].'cm';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'pot_diameter'){
					$content="盆    径：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = $value[0].'-'.$value[1].'cm';
					}else{
						$str = $value[0].'cm';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'age'){
					$content="苗    龄：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = $value[0].'-'.$value[1].'年';
					}else{
						$str = $value[0].'年';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'plant_height'){
					$content="株    高：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = (100*$value[0]).'-'.(100*$value[1]).'cm';
					}else{
						$str = (100*$value[0]).'cm';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'plant_height_cm'){
					$content="株    高：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = $value[0].'-'.$value[1].'cm';
					}else{
						$str = $value[0].'cm';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'crown'){
					$content="冠    幅：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = (100*$value[0]).'-'.(100*$value[1]).'cm';
					}else{
						$str = (100*$value[0]).'cm';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'crown_cm'){
					$content="冠    幅：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = $value[0].'-'.$value[1].'cm';
					}else{
						$str = $value[0].'cm';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'branch_length'){
					$content="分 枝 长：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = (100*$value[0]).'-'.(100*$value[1]).'cm';
					}else{
						$str = (100*$value[0]).'cm';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'bough_length'){
					$content="主 枝 长：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = (100*$value[0]).'-'.(100*$value[1]).'cm';
					}else{
						$str = (100*$value[0]).'cm';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'branch_point_height'){
					$content="分枝点高：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = (100*$value[0]).'-'.(100*$value[1]).'cm';
					}else{
						$str = (100*$value[0]).'cm';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'branch_number'){
					$content="分 枝 数：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = $value[0].'-'.$value[1].'个';
					}else{
						$str = $value[0].'个';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'bough_number'){
					$content="主 枝 数：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					if(count($value) > 1){
						$str = $value[0].'-'.$value[1].'个';
					}else{
						$str = $value[0].'个';
					}
					$content=$str;
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}elseif($attribute[$i] == 'substrate'){
					$content="基    质：";
					imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
					$content=$value[0];
					imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
				}
			}
		}
		$heights += 30;
		imagefilledrectangle ( $image, 230, $heights, 900, $heights, $linecolor);

		// $content="报价方式：";
		// $heights += 70;
		// imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);

		// $content="配送地点：";
		// $heights += 70;
		// imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);
		if($userinfo['address']){
			$content="用苗区域：";
			$heights += 70;
			imagettftext($image, 40, 0, 230, $heights, $color, $font, $content);


			$content = Createtenderimage::autowrap(35, 0, $font, $userinfo['address'],400);
			imagettftext($image, 35, 0, 500, $heights, $color, $font, $content);
			if(Createtenderimage::$overwidth){
				$heights += Createtenderimage::$count*35;
				Createtenderimage::$overwidth = false;
			}
		}


		$content="招标编号：";
		$heights += 100;
		imagettftext($image, 40, 0, 130, $heights, $color, $font, $content);

		$content=$result[0]['id'];
		imagettftext($image, 35, 0, 430, $heights, $color, $font, $content);


		$content="招 标 人：";
		$heights += 65;
		imagettftext($image, 40, 0, 130, $heights, $color, $font, $content);

		$content = Createtenderimage::autowrap(35, 0, $font, $userinfo['username'],450);
		imagettftext($image, 35, 0, 430, $heights, $color, $font, $content);

		if(Createtenderimage::$overwidth){
			$heights += Createtenderimage::$count*35;
			Createtenderimage::$overwidth = false;
		}
		$content="联系电话：";
		$heights += 65;
		imagettftext($image, 40, 0, 130, $heights, $color, $font, $content);

		$content=$userinfo['userphone'];
		imagettftext($image, 35, 0, 430, $heights, $color, $font, $content);


		$content="有效期至：";
		$heights += 65;
		imagettftext($image, 40, 0, 130, $heights, $color, $font, $content);


		$content=$userinfo['expiration_date'];
		imagettftext($image, 35, 0, 430, $heights, $color, $font, $content);

		if(!$qrcodeid){
			$qrcodeid = date("YmdHis",time());
			$sql = 'update tree_order_index set qrcode=? where id=?';
			$result = $db->prepare_exec($sql,array($qrcodeid , $orderid));
		} 

		$qrcode = QRcodeCreate::bid($qrcodeid);

		$heights += 65;

		imagecopyresampled($image, $qrcode, 346, $heights, 0, 0, 430,430,430,430);

		$content="长按二维码报价";
		$heights += 490;
		imagettftext($image, 30, 0, 430, $heights, $color, $font, $content);

		unset($db);
		imagejpeg($image, '../tenderimage/'.$qrcodeid.'.jpg');
		imagedestroy($image);
		return $qrcodeid;
	}
}

