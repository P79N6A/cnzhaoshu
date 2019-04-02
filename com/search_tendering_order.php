<?php 
	require 'checkhost.php';
	require 'db2.php';
	
	// 获取参数

	$orderid = $_GET['orderid'];
	$userid = $_GET['userid'];

	if ($orderid) {
		$db = new db();
		
		$sql = 'select * from tree_order_index where id=?';
		$result = $db->prepare_query($sql,array($orderid))[0];
	
		$sql = 'select * from tree_order where orderid=?';
		$results = $db->prepare_query($sql,array($orderid));

		if($userid != $result['userid']){
			$sql = 'select role from user where userid=?';
			$roless = $db->prepare_query($sql,array($userid));
			if(($roless[0]['role'] == 8) || ($roless[0]['role'] == 9)){
				$userid = $result['userid'];
			}else{
				return false;
				exit;
			}
		}

		$sql = 'select supplier_id from supplier where userid=? and state=2';
		$resultsu = $db->prepare_query($sql,array($userid));

		$supplier_idstring = '';
		$supplier_idstrings ='';
		for ($i=0; $i < count($resultsu); $i++) { 
			$supplier_idstring .= $resultsu[$i]['supplier_id'].',';
		}
		$supplier_idstring = rtrim($supplier_idstring,',');
		if($supplier_idstring) $supplier_idstrings = ' and userid not in ('.$supplier_idstring.')';

		$alladdress = [];
		$date = [];
		$all = [];
		for ($i=0; $i < count($results); $i++) { 
			$data = $results[$i];
			$date[$i] = [];
			$sql = 'select name,userid,shopid,username,userphone,userisrenzheng,city,province from v_tree where name = \''.$data['name'].'\'';
			if($data['trunk_diameter']){
				$trunk_diameter = explode(',', $data['trunk_diameter']);
				if(count($trunk_diameter) > 1){
					$sql .= ' and dbh >= '.$trunk_diameter[0].' and dbh <= '.$trunk_diameter[1];
				}else if($trunk_diameter[0]){
					$sql .= ' and dbh = '.$trunk_diameter[0];
				}
			}
			if($data['ground_diameter']){
				$ground_diameter = explode(',', $data['ground_diameter']);
				if(count($ground_diameter) > 1){
					$sql .= ' and dbh >= '.$ground_diameter[0].' and dbh <= '.$ground_diameter[1];
				}else if($ground_diameter[0]){
					$sql .= ' and dbh = '.$ground_diameter[0];
				}
			}
			if($data['pot_diameter']){
				$pot_diameter = explode(',', $data['pot_diameter']);
				if(count($pot_diameter) > 1){
					$sql .= ' and dbh >= '.$pot_diameter[0].' and dbh <= '.$pot_diameter[1];
				}else if($pot_diameter[0]){
					$sql .= ' and dbh = '.$pot_diameter[0];
				}
			}
			if($data['age']){
				$sql .= ' and age = '.$data['age'];
			}
			if($data['plant_height']){
				$plant_height = explode(',', $data['plant_height']);
				if(count($plant_height) > 1){
					$sql .= ' and height >= '.$plant_height[0].' and height <= '.$plant_height[1];
				}else if($plant_height[0]){
					$sql .= ' and height = '.$plant_height[0];
				}
			}
			if($data['plant_height_cm']){
				$plant_height_cm = explode(',', $data['plant_height_cm']);
				if(count($plant_height_cm) > 1){
					$sql .= ' and height >= '.($plant_height_cm[0]/100).' and height <= '.($plant_height_cm[1]/100);
				}else if($plant_height_cm[0]){
					$sql .= ' and height = '.($plant_height_cm[0]/100);
				}
			}
			if($data['crown']){
				$crown = explode(',', $data['crown']);
				if(count($crown) > 1){
					$sql .= ' and crownwidth >= '.$crown[0].' and crownwidth <= '.$crown[1];
				}else if($crown[0]){
					$sql .= ' and crownwidth = '.$crown[0];
				}
			}
			if($data['crown_cm']){
				$crown_cm = explode(',', $data['crown_cm']);
				if(count($crown_cm) > 1){
					$sql .= ' and crownwidth >= '.($crown_cm[0]/100).' and crownwidth <= '.($crown_cm[0]/100);
				}else if($crown_cm[0]){
					$sql .= ' and crownwidth = '.($crown_cm[0]/100);
				}
			}
			if($data['branch_length']){
				$branch_length = explode(',', $data['branch_length']);
				if(count($branch_length) > 1){
					$sql .= ' and height >= '.$branch_length[0].' and height <= '.$branch_length[1];
				}else if($branch_length[0]){
					$sql .= ' and height = '.$branch_length[0];
				}
			}
			if($data['bough_length']){
				$bough_length = explode(',', $data['bough_length']);
				if(count($bough_length) > 1){
					$sql .= ' and height >= '.$bough_length[0].' and height <= '.$bough_length[1];
				}else if($bough_length[0]){
					$sql .= ' and height = '.$bough_length[0];
				}
			}
			if($data['branch_point_height']){
				$branch_point_height = explode(',', $data['branch_point_height']);
				if(count($branch_point_height) > 1){
					$sql .= ' and branch_point_height >= '.$branch_point_height[0].' and branch_point_height <= '.$branch_point_height[1];
				}else if($branch_point_height[0]){
					$sql .= ' and branch_point_height = '.$branch_point_height[0];
				}
			}
			if($data['branch_number']){
				$branch_number = explode(',', $data['branch_number']);
				if(count($branch_number) > 1){
					$sql .= ' and branch_bough_number >= '.$branch_number[0].' and branch_bough_number <= '.$branch_number[1];
				}else if($branch_number[0]){
					$sql .= ' and branch_bough_number = '.$branch_number[0];
				}
			}
			if($data['bough_number']){
				$bough_number = explode(',', $data['bough_number']);
				if(count($bough_number) > 1){
					$sql .= ' and branch_bough_number >= '.$bough_number[0].' and branch_bough_number <= '.$bough_number[1];
				}else if($bough_number[0]){
					$sql .= ' and branch_bough_number = '.$bough_number[0];
				}
			}
			if($data['substrate']){
				$sql .= ' and substrate = '.$data['substrate'];
			}
			if($data['address_price']){
				$address_price = explode(',', $data['address_price']);
				$address = [];
				for ($m=0; $m < count($address_price); $m++) {
					$z = 1; 
					$address_pricea = explode(':', $address_price[$m]);
					$address[count($address)] = $address_pricea[0];
					for ($k=0; $k < count($alladdress); $k++) { 
						if($alladdress[$k] == $address_pricea[0]){
							$z = 0;
						}
					}
					if($z) $alladdress[count($alladdress)] = $address_pricea[0];
				}
				if(count($address)){
					$sql .= ' and (';
					for ($j=0; $j < count($address); $j++) { 
						if($j==0){
							$sql .= '( city = \''.$address[$j].'\' or province = \''.$address[$j].'\')';
						}else{
							$sql .= ' or ( city = \''.$address[$j].'\' or province = \''.$address[$j].'\')';
						}
					}
					$sql .= ') group by shopid';
				}
			}
			$sql .= $supplier_idstrings;
			$result1 = $db->prepare_query($sql);
			$date[$i]['numbern'] = 1+i;
			$date[$i]['treename'] = $data['name'];
			$date[$i]['data'] = $result1;
			$date[$i]['id'] = $data['id'];
		}
			
		$all['supplierid'] = $resultsu;
		$all['alladdress'] = $alladdress;
		$all['company'] = [];
		$all['company'] = $date;
		$all['orderinfo'] = $result;
		echo json_encode($all);
		unset($db);

	}

























 ?>