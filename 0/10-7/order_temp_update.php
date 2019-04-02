<?php 
	require 'checkhost.php';
	require('db2.php');
	
	$userid = $_GET['uid'];
	$data = $_GET['data'];
	$data = json_decode($data, true);
	
	$fileds = array();
	$values = array();
	$fileds_kay = array();
	if (isset($data)) {
		!$userid && exit;
		foreach ($data as $key => $value) {
			if(is_array($value)){
				if(isset($value[1])){
					$data[$key] = $value[0].','.$value[1];
				}elseif($value[0]){
					$data[$key] = $value[0];
				}	
			}elseif($key == 'id'){
				$data[$key] = $value;
			}
		}
		$array_key = ['id','name','unit','type','typename','count','trunk_diameter','ground_diameter','plant_height','crown','branch_number','bough_number','age','branch_length','bough_length','branch_point_height','pot_diameter','plant_height_cm','crown_cm','substrate'];
		foreach ($array_key as $key_key => $key_value) {
			array_push($fileds_kay,$key_value);
			array_push($fileds,$key_value.'=?');
		}
		for ($i=0; $i < count($fileds_kay); $i++) { 
			if($data[$fileds_kay[$i]]){
				array_push($values,$data[$fileds_kay[$i]]);
			}else{
				array_push($values,'');
			}
		}
		$db = new db();
		array_push($values,$data['id'],$userid);
		$sql = 'update tree_order_temp set '.join(',' , $fileds).' where id=? and userid=?';
		$result = $db->prepare_exec( $sql, $values);
		echo $result;
		unset($db);
	}

	

























 ?>