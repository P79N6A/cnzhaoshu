<?php
// 统计关键词搜索频次
require 'db.php';


$data = $_POST['data'];	
$userid = $_POST['userid'];	


if ($userid && $data) {
	$data = json_decode($data, true);
	$fileds = [];
	$values = [];

	foreach ($data as $key => $value) {
		array_push($fileds, $key.'=?');
		array_push($values, $value);
	}

	$sql = 'update user set '.join(',', $fileds).' where userid=?';
	array_push($values, $userid);
	
	$db = new db();
	$result = $db->prepare_exec($sql, $values);
	unset($db);

	echo $result;

}

?>