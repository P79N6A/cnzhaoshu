<?php
// 从CSV批量导入等级字典和属性字典
require 'checkhost.php';
require 'db2.php';
require 'pinyin.php';

// 规格：
// 5胸径、6地经、7盆径
// 8冠幅
// 9株高、10条长、11主蔓长
// 12分支点高
// 13分支数
// 14主枝数（每丛枝数）
// 15苗龄

$attributes = array(
	'trunk_diameter1' => 5, 
	'trunk_diameter2' => 5, 
	'ground_diameter1' => 6, 
	'ground_diameter2' => 6, 
	'basin_diameter1' => 7, 
	'basin_diameter2' => 7, 
	'age' => 8,
	'crown1' => 9, 
	'crown2' => 9, 
	'plant_height1' => 10, 
	'plant_height2' => 10, 
	'branch_length1' => 11, 
	'branch_length2' => 11, 
	'bough_length1' => 12, 
	'bough_length2' => 12, 
	'branch_point_height1_min' => 13, 
	'branch_point_height1_max' => 13, 
	'branch_point_height2_min' => 13, 
	'branch_point_height2_max' => 13, 
	'branch_number1' => 14, 
	'branch_number2' => 14, 
	'bough_number1' => 15, 
	'bough_number2' => 15 
);




$type = $_REQUEST['type'];	
$typename = $_REQUEST['typename'];	
$data = $_REQUEST['data'];	

if (isset($data) && isset($type) && isset($typename)) {

	$data = json_decode($data, true);

	$db = new db();

	foreach ($data as $row) {
		// 逐行处理
		$grade_fields = array();
		$sql_grade_array = array();

		$attribute_fields = array('type=?', 'typename=?');
		$sql_attribute_array = array($type, $typename);
		$attribute_ids = array();

		foreach ($row as $key => $value) {
			if ($value) {
				// 逐列处理
				array_push($grade_fields, $key.'=?');
				array_push($sql_grade_array, $value);

				if ($key=='name') {
					array_push($attribute_fields, 'name=?');
					array_push($sql_attribute_array, $value);
				} else if ($key=='ldname') {					
					array_push($attribute_fields, 'ldname=?');
					array_push($sql_attribute_array, $value);
				}

				$attribute_id = $attributes[$key];
				if ($attribute_id) {
					array_push($attribute_ids, $attribute_id);
				}
			}
		}


		// 检查等级表里是否已经存在相同的记录，如果有，则不追加
		$sql = 'select id from dictionary_grade where '.join(' and ',$grade_fields);
		$result = $db->prepare_query( $sql, $sql_grade_array );
		// echo json_encode($result).', '.json_encode($sql_grade_array).', '.$sql.'<br><br>';
		if (!$result) {
			array_push($grade_fields, 'type=?','typename=?');
			array_push($sql_grade_array, $type,$typename);

			$sql = 'insert into dictionary_grade set '.join(',',$grade_fields);
			$db->prepare_exec( $sql, $sql_grade_array );
			// echo json_encode($sql_grade_array).', '.$sql.'<br>';
		}
		
		$attribute_ids = array_unique($attribute_ids); //去重、排序
		sort($attribute_ids);

		array_push($attribute_fields, 'attribute=?', 'jianpin=?', 'unit=?');
		array_push($sql_attribute_array, join(',',$attribute_ids), getPinyin($row['name']), '株');
		// 插入属性字典
		$sql = 'insert ignore into dictionary_attribute set '.join(',',$attribute_fields);
		$db->prepare_exec( $sql, $sql_attribute_array );
		// echo json_encode($sql_attribute_array).', '.$sql.'<br><br>';
	}

	unset($db);
}

?>