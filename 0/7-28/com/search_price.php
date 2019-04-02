<?php
// 根据名称规格返回各省价格
// 5:'trunk_diameter',
// 6:'ground_diameter',
// 7:'pot_diameter',
// 8:'crown',
// 9:'plant_height',
// 10:'branch_length',
// 11:'bough_length',
// 12:'branch_point_height',
// 13:'branch_number',
// 14:'bough_number'   
// var data = {"id":"051000000","name":"国槐","trunk_diameter":[10,12],"crown":[4],"plant_height":[4,5]};   
// $.getJSON('/com/search_price.php',{data:JSON.stringify(data)}function(json){...});

// [{"id":"050731019554","name":"国槐","trunk_diameter":["12"],"plant_height":["6"],"crown":["5"]}]
// if (empty($_SERVER['HTTP_REFERER'])) exit;

require 'db2.php';

$data = $_REQUEST["data"];

if (isset($data)) {
	$tree = json_decode($data, true);
	
	$db= new db();

	$tree['name'] = str_replace('蜡','腊',$tree['name']);
	$tree['name'] = str_replace('杆','干',$tree['name']);
	
	$fields = array('(name=? or name like ?)');
	$sql_array = array($tree['name'], $tree['name'].'_');

	foreach ($tree as $key => $value) {
		if ($key=='trunk_diameter' || $key=='ground_diameter' || $key=='pot_diameter') {
			if (count($value)==1){
				array_push($fields, 'dbh=?');
				array_push($sql_array, $value[0]);
			} else {
				array_push($fields, 'dbh>=? and dbh<=?');
				array_push($sql_array, $value[0], $value[1]);				
			}
		} else if ($key=='crown') {
			if (count($value)==1){
				array_push($fields, 'crownwidth=?');
				array_push($sql_array, $value[0]);
			} else {
				array_push($fields, 'crownwidth>=? and crownwidth<=?');
				array_push($sql_array, $value[0], $value[1]);				
			}
		} else if ($key=='plant_height' || $key=='branch_length' || $key=='bough_length') {
			if (count($value)==1){
				array_push($fields, 'height=?');
				array_push($sql_array, $value[0]);
			} else {
				array_push($fields, 'height>=? and height<=?');
				array_push($sql_array, $value[0], $value[1]);				
			}
		} else if ($key=='plant_height_cm') {
			if (count($value)==1){
				array_push($fields, 'height=?');
				array_push($sql_array, $value[0]/100);
			} else {
				array_push($fields, 'height>=? and height<=?');
				array_push($sql_array, $value[0]/100, $value[1]/100);				
			}
		} else if ($key=='crown_cm') {
			if (count($value)==1){
				array_push($fields, 'crownwidth=?');
				array_push($sql_array, $value[0]/100);
			} else {
				array_push($fields, 'crownwidth>=? and crownwidth<=?');
				array_push($sql_array, $value[0]/100, $value[1]/100);				
			}
		}
		// else if ($key=='branch_point_height') {
		// 	if (count($value)==1){
		// 		array_push($fields, 'branch_point_height=?');
		// 		array_push($sql_array, $value[0]);
		// 	} else {
		// 		array_push($fields, 'branch_point_height>=? and branch_point_height<=?');
		// 		array_push($sql_array, $value[0], $value[1]);				
		// 	}
		// } else ($key=='branch_number' || $key=='bough_number') {
		// 	if (count($value)==1){
		// 		array_push($fields, 'branch_number=?');
		// 		array_push($sql_array, $value[0]);
		// 	} else {
		// 		array_push($fields, 'branch_number>=? and branch_number<=?');
		// 		array_push($sql_array, $value[0], $value[1]);				
		// 	}
		// } 
	}

	// 省
	$sql = 'select province,avg(price) as avg,count(treeid) as count,sum(count) as total,min(price) as min,max(price) as max from tree where price>0 and state>0 and '.join(' and ',$fields).' group by province order by avg';

	$provincelist = $db->prepare_query( $sql, $sql_array );

	// 地市
	$sql = 'select province,city,avg(price) as avg,count(treeid) as count,sum(count) as total,min(price) as min,max(price) as max from tree where price>0 and state>0 and '.join(' and ',$fields).' group by city order by province,avg';

	$citylist = $db->prepare_query( $sql, $sql_array );
	foreach ($provincelist as $i => $province) {		
		$isBegin = true;
		$provincelist[$i]['avg'] = round($provincelist[$i]['avg'],2);
		$provincelist[$i]['city'] = array();

		foreach ($citylist as $j => $city) {
			if ($city['province']==$province['province']) {
				unset($city['province']);
				$city['avg'] = round($city['avg'],2);

				array_push($provincelist[$i]['city'], $city);

				$isBegin && $isBegin=false;
			} else if (!$isBegin) {
				break;
			} 
		}
	}

	$pricelist = array('id'=>$tree['id'], 'price'=>$provincelist);

	unset($db);
	echo json_encode($pricelist); 
}
?>