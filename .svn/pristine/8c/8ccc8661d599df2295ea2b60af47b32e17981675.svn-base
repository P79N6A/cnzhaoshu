<?php
// 根据id更新 等级表
require 'checkhost.php';
require 'db2.php';

$data = $_REQUEST['data'];	

if (isset($data)) {
	$data = json_decode($data, true);
	!$data['id'] && exit;

	$grade_fields = array();
	$sql_grade_array = array();

	foreach ($data as $key => $value) {
		if ($value) {
			// 逐列处理
			array_push($grade_fields, $key.'=?');
			array_push($sql_grade_array, $value);
		}
	}

	$sql = 'update dictionary_grade set '.join(',',$grade_fields).' where id=?';
	array_push($sql_grade_array, $data['id']);
	// echo json_encode($sql_grade_array).', '.$sql.'<br>';

	$db = new db();
	$db->prepare_exec( $sql, $sql_grade_array );
	unset($db);
}	

?>