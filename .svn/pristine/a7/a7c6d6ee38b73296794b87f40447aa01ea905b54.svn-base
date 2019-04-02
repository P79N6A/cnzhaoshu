<?php

require 'db2.php';


$address=[['山东','河北'],['山东','河北']];

$datas = [["id"=>"050334704761","userid"=>29908,"name"=>"国槐","unit"=>"株","type"=>1,"typename"=>"落叶乔木","count"=>1,"trunk_diameter"=>["20","25"]],["id"=>"050341651236","userid"=>29908,"name"=>"白腊","unit"=>"株","type"=>1,"typename"=>"落叶乔木","count"=>10,"trunk_diameter"=>["20","30"],"plant_height"=>["1","6"]]];
$date = [];
$db = new db();
for ($i=0; $i < count($datas); $i++) { 
	$data = $datas[$i];
	$date[$i] = [];
	$sql = 'select name,userid,shopid,username,userphone,invoice,userisrenzheng,city,province from v_tree where name = \''.$data['name'].'\'';
	if($data['trunk_diameter'][0]&&$data['trunk_diameter'][1]){
		$sql .= ' and dbh > '.$data['trunk_diameter'][0].' and dbh <'.$data['trunk_diameter'][1];
	}else if($data['trunk_diameter'][0]){
		$sql .= ' and dbh = '.$data['trunk_diameter'][0];
	}
	if($data['ground_diameter']&&$data['ground_diameter'][1]){
		$sql .= ' and dbh > '.$data['ground_diameter'][0].' and dbh <'.$data['ground_diameter'][1];
	}else if($data['ground_diameter']){
		$sql .= ' and dbh = '.$data['ground_diameter'][0];
	}
	if($data['pot_diameter']&&$data['pot_diameter'][1]){
		$sql .= ' and dbh > '.$data['pot_diameter'][0].' and dbh <'.$data['pot_diameter'][1];
	}else if($data['pot_diameter']){
		$sql .= ' and dbh = '.$data['pot_diameter'][0];
	}
	if($data['age']){
		$sql .= ' and age = '.$data['age'][0];
	}
	if($data['plant_height']&&$data['plant_height'][1]){
		$sql .= ' and height > '.$data['plant_height'][0].' and height <'.$data['plant_height'][1];
	}else if($data['plant_height']){
		$sql .= ' and height = '.$data['plant_height'][0];
	}
	if($data['plant_height_cm']&&$data['plant_height_cm'][1]){
		$sql .= ' and height > '.$data['plant_height_cm'][0].' and height <'.$data['plant_height_cm'][1];
	}else if($data['plant_height_cm']){
		$sql .= ' and height = '.$data['plant_height_cm'][0];
	}
	if($data['crown']&&$data['crown'][1]){
		$sql .= ' and crownwidth > '.$data['crown'][0].' and crownwidth <'.$data['crown'][1];
	}else if($data['crown']){
		$sql .= ' and crownwidth = '.$data['crown'][0];
	}
	if($data['crown_cm']&&$data['crown_cm'][1]){
		$sql .= ' and crownwidth > '.$data['crown_cm'][0].' and crownwidth <'.$data['crown_cm'][1];
	}else if($data['crown_cm']){
		$sql .= ' and crownwidth = '.$data['crown_cm'][0];
	}
	if($data['branch_length']&&$data['branch_length'][1]){
		$sql .= ' and height > '.$data['branch_length'][0].' and height <'.$data['branch_length'][1];
	}else if($data['branch_length']){
		$sql .= ' and height = '.$data['branch_length'][0];
	}
	if($data['bough_length']&&$data['bough_length'][1]){
		$sql .= ' and height > '.$data['bough_length'][0].' and height <'.$data['bough_length'][1];
	}else if($data['bough_length']){
		$sql .= ' and height = '.$data['bough_length'][0];
	}
	if($data['branch_point_height']&&$data['branch_point_height'][1]){
		$sql .= ' and branch_point_height > '.$data['branch_point_height'][0].' and branch_point_height <'.$data['branch_point_height'][1];
	}else if($data['branch_point_height']){
		$sql .= ' and branch_point_height = '.$data['branch_point_height'][0];
	}
	if($data['branch_number']&&$data['branch_number'][1]){
		$sql .= ' and branch_bough_number > '.$data['branch_number'][0].' and branch_bough_number <'.$data['branch_number'][1];
	}else if($data['branch_number']){
		$sql .= ' and branch_bough_number = '.$data['branch_number'][0];
	}
	if($data['bough_number']&&$data['bough_number'][1]){
		$sql .= ' and branch_bough_number > '.$data['bough_number'][0].' and branch_bough_number <'.$data['bough_number'][1];
	}else if($data['bough_number']){
		$sql .= ' and branch_bough_number = '.$data['bough_number'][0];
	}
	if($data['substrate']){
		$sql .= ' and substrate = '.$data['substrate'][0];
	}
	if($address[$i]){
		$sql .= ' and (';
		for ($j=0; $j < count($address[$i]); $j++) { 
			if($j==0){
				$sql .= '( city = \''.$address[$i][$j].'\' or province = \''.$address[$i][$j].'\')';
			}else{
				$sql .= ' or ( city = \''.$address[$i][$j].'\' or province = \''.$address[$i][$j].'\')';
			}
		}
	}
	$sql .= ') group by shopid';

	$result = $db->prepare_query($sql);
	$date[$i] = $result;
}
	echo json_encode($date);
	unset($db);


