<?php

require 'db.php';
require 'qrcode.create.php';
require 'create.tenderimage.php';



$datas = $_GET['data'];	
$userid = $_GET['uid'];	
$useraddress = $_GET['useraddress'];
$datas = json_decode($datas, true);	


$showdata = array();
for ($t=1; $t < 13; $t++) { 
	for($i=0; $i < count($datas); $i++){
		$data = $datas[$i];
		if($datas[$i]['type'] == $t){
			$k = count($showdata);
			$showdata[$k] = array();
			$showdata[$k]['name'] = $data['name'];
			$showdata[$k]['count'] = $data['count'];
			$showdata[$k]['unit'] = $data['unit'];

			$attribute = '';
			if($data['trunk_diameter'][0]&&$data['trunk_diameter'][1]){
				$attribute .= '胸径'.$data['trunk_diameter'][0].'-'.$data['trunk_diameter'][1].'cm，';
			}else if($data['trunk_diameter'][0]){
				$attribute .= '胸径'.$data['trunk_diameter'][0].'cm，';
			}
			if($data['ground_diameter']&&$data['ground_diameter'][1]){
				$attribute .= '地径'.$data['ground_diameter'][0].'-'.$data['ground_diameter'][1].'cm，';
			}else if($data['ground_diameter']){
				$attribute .= '地径'.$data['ground_diameter'][0].'cm，';
			}
			if($data['pot_diameter']&&$data['pot_diameter'][1]){
				$attribute .= '盆径'.$data['pot_diameter'][0].'-'.$data['pot_diameter'][1].'cm，';
			}else if($data['pot_diameter']){
				$attribute .= '盆径'.$data['pot_diameter'][0].'cm，';
			}
			if($data['age']){
				$attribute .= '苗龄'.$data['age'][0].'年，';
			}
			if($data['plant_height']&&$data['plant_height'][1]){
				$attribute .= '株高'.((float)$data['plant_height'][0]*100).'-'.((float)$data['plant_height'][1]*100).'cm，';
			}else if($data['plant_height']){
				$attribute .= '株高'.((float)$data['plant_height'][0]*100).'cm，';
			}
			if($data['plant_height_cm']&&$data['plant_height_cm'][1]){
				$attribute .= '株高'.((float)$data['plant_height_cm'][0]).'-'.((float)$data['plant_height_cm'][1]).'cm，';
			}else if($data['plant_height_cm']){
				$attribute .= '株高'.((float)$data['plant_height_cm'][0]).'cm，';
			}
			if($data['crown']&&$data['crown'][1]){
				$attribute .= '冠幅'.((float)$data['crown'][0]*100).'-'.((float)$data['crown'][1]*100).'cm，';
			}else if($data['crown']){
				$attribute .= '冠幅'.((float)$data['crown'][0]*100).'cm，';
			}
			if($data['crown_cm']&&$data['crown_cm'][1]){
				$attribute .= '冠幅'.((float)$data['crown_cm'][0]).'-'.((float)$data['crown_cm'][1]).'cm，';
			}else if($data['crown_cm']){
				$attribute .= '冠幅'.((float)$data['crown_cm'][0]).'cm，';
			}
			if($data['branch_length']&&$data['branch_length'][1]){
				$attribute .= '分枝长'.((float)$data['branch_length'][0]*100).'-'.((float)$data['branch_length'][1]*100).'cm，';
			}else if($data['branch_length']){
				$attribute .= '分枝长'.((float)$data['branch_length'][0]*100).'cm，';
			}
			if($data['bough_length']&&$data['bough_length'][1]){
				$attribute .= '主枝长'.((float)$data['bough_length'][0]*100).'-'.((float)$data['bough_length'][1]*100).'cm，';
			}else if($data['bough_length']){
				$attribute .= '主枝长'.((float)$data['bough_length'][0]*100).'cm，';
			}
			if($data['branch_point_height']&&$data['branch_point_height'][1]){
				$attribute .= '分枝点高'.((float)$data['branch_point_height'][0]*100).'-'.((float)$data['branch_point_height'][1]*100).'cm，';
			}else if($data['branch_point_height']){
				$attribute .= '分枝点高'.((float)$data['branch_point_height'][0]*100).'cm，';
			}
			if($data['branch_number']&&$data['branch_number'][1]){
				$attribute .= '分枝数'.$data['branch_number'][0].'-'.$data['branch_number'][1].'个，';
			}else if($data['branch_number']){
				$attribute .= '分枝数'.$data['branch_number'][0].'个，';
			}
			if($data['bough_number']&&$data['bough_number'][1]){
				$attribute .= '主枝数'.$data['bough_number'][0].'-'.$data['bough_number'][1].'个，';
			}else if($data['bough_number']){
				$attribute .= '主枝数'.$data['bough_number'][0].'个，';
			}
			if($data['substrate']){
				$attribute .= '基质:'.$data['substrate'].'，';
			}
			$attribute = rtrim($attribute, "，");
			$showdata[$k]['attribute'] = $attribute;
		}
	}
}

$qrcodeid = date("Ymdhis",time());

$qrcode = QRcodeCreate::bid($qrcodeid);
imagepng($qrcode,'../tenderimage/qrcode/'.$qrcodeid.'.png');
$qrcode = '../tenderimage/qrcode/'.$qrcodeid.'.png';
$image = Createtenderinage::create($userid,$useraddress,$showdata,$qrcode);

header('content-type:image/jpg');
imagejpeg($image);
imagejpeg($image,'newimagejpg');
imagejpeg($image, '../tenderimage/qrcodeimage/'.$qrcodeid.'.jpg');
imagedestroy($image);

