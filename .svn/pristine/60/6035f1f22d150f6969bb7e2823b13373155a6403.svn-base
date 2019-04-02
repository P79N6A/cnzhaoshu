<?php
// 批量更新开放平台菜单，未认证公众号设置菜单无效
// 规格：
// 5胸径、6地经、7盆径，dbh
// 8苗龄 age
// 9冠幅，crown_width
// 10株高、11条长、12主蔓长，height
// 13分支点高
// 14分支数，15主枝数（每丛枝数）

header("Content-type: text/html;charset=utf-8");

require '../com/db2.php';

$db = new db();
$attributes = $db->query('select name,unit,attribute from dictionary_attribute');

foreach ($attributes as $attribute) {
	$field_array = array();

	if ($attribute['attribute']) {
		$attribute_array = explode(',', $attribute['attribute']);
		if (!in_array(5, $attribute_array) && !in_array(6, $attribute_array) && !in_array(7, $attribute_array)) {
			array_push($field_array, 'dbh=NULL');
		}else{
			if (in_array(5, $attribute_array)) {
				array_push($field_array, 'dbh_type=5');
			} else if (in_array(6, $attribute_array)) {
				array_push($field_array, 'dbh_type=6');
			} else if (in_array(7, $attribute_array)) {
				array_push($field_array, 'dbh_type=7');
			}
		}

		if (!in_array(9, $attribute_array)) {
			array_push($field_array, 'crownwidth=NULL');
		}

		if (!in_array(10, $attribute_array)) {
			array_push($field_array, 'height=NULL');
		} else {
			if (in_array(10, $attribute_array)) {
				array_push($field_array, 'height_type=10');
			} else if (in_array(11, $attribute_array)) {
				array_push($field_array, 'height_type=11');
			} else if (in_array(12, $attribute_array)) {
				array_push($field_array, 'height_type=12');
			}			
		}
	} else {
		array_push($field_array, 'dbh=NULL,crownwidth=NULL,height=NULL');
	}

	array_push($field_array, 'unit=\''.$attribute['unit'].'\'');
		
	$sql = 'update tree set '.join(',',$field_array).' where name=\''.$attribute['name'].'\'';
	$db->exec($sql);
	// echo $sql.'<br>';
	// break;
}

unset($db);

echo 'OK';