<?php

class Createimage{

	public static function create($orderid,$qrcodeid){
		$db = new db();

		$sql = 'select * from tree_order_index where id=?';
		$result = $db->prepare_query($sql,array($orderid))[0];

		$sql = 'select * from tree_order where orderid=?';
		$datas = $db->prepare_query($sql,array($orderid));


		$userid = $result['userid'];	
		$useraddress = $result['address'];
		$expiration_date = $result['expiration_date'];


		$showdata = array();
		for($i=0; $i < count($datas); $i++){
			$data = $datas[$i];
			$k = count($showdata);
			$showdata[$k] = array();
			$showdata[$k]['name'] = $data['name'];
			$showdata[$k]['count'] = $data['count'];
			$showdata[$k]['unit'] = $data['unit'];

			$attribute = '';

			if($data['trunk_diameter']){
				$trunk_diameter = explode(',', $data['trunk_diameter']);
				if(count($trunk_diameter) > 1){
					$attribute .= '胸径'.$trunk_diameter[0].'-'.$trunk_diameter[1].'cm，';
				}else if($trunk_diameter[0]){
					$attribute .= '胸径'.$trunk_diameter[0].'cm，';
				}
			}

			if($data['ground_diameter']){
				$ground_diameter = explode(',', $data['ground_diameter']);
				if(count($ground_diameter) > 1){
					$attribute .= '地径'.$ground_diameter[0].'-'.$ground_diameter[1].'cm，';
				}else if($ground_diameter[0]){
					$attribute .= '地径'.$ground_diameter[0].'cm，';
				}
			}

			if($data['pot_diameter']){
				$pot_diameter = explode(',', $data['pot_diameter']);
				if(count($pot_diameter) > 1){
					$attribute .= '盆径'.$pot_diameter[0].'-'.$pot_diameter[1].'cm，';
				}else if($pot_diameter[0]){
					$attribute .= '盆径'.$pot_diameter[0].'cm，';
				}
			}

			if($data['age']){
				$attribute .= '苗龄'.$data['age'][0].'年，';
			}
			
			if($data['plant_height']){
				$plant_height = explode(',', $data['plant_height']);
				if(count($plant_height) > 1){
					$attribute .= '株高'.((float)$plant_height[0]*100).'-'.((float)$plant_height[1]*100).'cm，';
				}else if($plant_height[0]){
					$attribute .= '株高'.((float)$plant_height[0]*100).'cm，';
				}
			}

			if($data['plant_height_cm']){
				$plant_height_cm = explode(',', $data['plant_height_cm']);
				if(count($plant_height_cm) > 1){
					$attribute .= '株高'.((float)$plant_height_cm[0]).'-'.((float)$plant_height_cm[1]).'cm，';
				}else if($plant_height_cm[0]){
					$attribute .= '株高'.((float)$plant_height_cm[0]).'cm，';
				}
			}

			if($data['crown']){
				$crown = explode(',', $data['crown']);
				if(count($crown) > 1){
					$attribute .= '冠幅'.((float)$crown[0]*100).'-'.((float)$crown[1]*100).'cm，';
				}else if($crown[0]){
					$attribute .= '冠幅'.((float)$crown[0]*100).'cm，';
				}
			}

			if($data['crown_cm']){
				$crown_cm = explode(',', $data['crown_cm']);
				if(count($crown_cm) > 1){
					$attribute .= '冠幅'.((float)$crown_cm[0]).'-'.((float)$crown_cm[1]).'cm，';
				}else if($crown_cm[0]){
					$attribute .= '冠幅'.((float)$crown_cm[0]).'cm，';
				}
			}

			if($data['branch_length']){
				$branch_length = explode(',', $data['branch_length']);
				if(count($branch_length) > 1){
					$attribute .= '分枝长'.((float)$branch_length[0]*100).'-'.((float)$branch_length[1]*100).'cm，';
				}else if($branch_length[0]){
					$attribute .= '分枝长'.((float)$branch_length[0]*100).'cm，';
				}
			}

			if($data['bough_length']){
				$bough_length = explode(',', $data['bough_length']);
				if(count($bough_length) > 1){
					$attribute .= '主枝长'.((float)$bough_length[0]*100).'-'.((float)$bough_length[1]*100).'cm，';
				}else if($bough_length[0]){
					$attribute .= '主枝长'.((float)$bough_length[0]*100).'cm，';
				}
			}

			if($data['branch_point_height']){
				$branch_point_height = explode(',', $data['branch_point_height']);
				if(count($branch_point_height) > 1){
					$attribute .= '分枝点高'.((float)$branch_point_height[0]*100).'-'.((float)$branch_point_height[1]*100).'cm，';
				}else if($branch_point_height[0]){
					$attribute .= '分枝点高'.((float)$branch_point_height[0]*100).'cm，';
				}
			}

			if($data['branch_number']){
				$branch_number = explode(',', $data['branch_number']);
				if(count($branch_number) > 1){
					$attribute .= '分枝数'.$branch_number[0].'-'.$branch_number[1].'个，';
				}else if($branch_number[0]){
					$attribute .= '分枝数'.$branch_number[0].'个，';
				}
			}

			if($data['bough_number']){
				$bough_number = explode(',', $data['bough_number']);
				if(count($bough_number) > 1){
					$attribute .= '主枝数'.$bough_number[0].'-'.$bough_number[1].'个，';
				}else if($bough_number[0]){
					$attribute .= '主枝数'.$bough_number[0].'个，';
				}
			}

			if($data['substrate']){
				$attribute .= '基质:'.$data['substrate'].'，';
			}
			$attribute = rtrim($attribute, "，");
			$showdata[$k]['attribute'] = $attribute;

		}

		if(!$qrcodeid){
			$qrcodeid = date("YmdHis",time());
			$sql = 'update tree_order_index set qrcode=? where id=?';
			$result = $db->prepare_exec($sql,array($qrcodeid , $orderid));
		} 


		$qrcode = QRcodeCreate::bid($qrcodeid);
		$image = Createtenderimage::create($expiration_date,$userid,$useraddress,$showdata,$qrcode);

		unset($db);
		
		imagejpeg($image, '../tenderimage/'.$qrcodeid.'.jpg');
		imagedestroy($image);
		return $qrcodeid;
	}
}




