<?php
// 统计关键词搜索频次
require 'db.php';


$data = $_POST['data'];	
$userid = $_POST['userid'];	
$shopid = $_POST['shopid'];	


if ($userid && $data) {
	$data = json_decode($data, true);
	$fileds = [];
	$values = [];

	foreach ($data as $key => $value) {
		array_push($fileds, $key.'=?');
		array_push($values, $value);
	}

	$db = new db();
	
	// 更新本店信息
	$sql = 'update user set '.join(',', $fileds).' where userid=?';
	array_push($values, $userid);
	$result = $db->prepare_exec($sql, $values);

	// 更新分店的 shopname
	if ($shopid == $userid && $data['name']) {
		$sql = 'update user set shopname=? where shopid=?';
		$db->prepare_exec($sql, array($data['name'], $shopid));
	}

	unset($db);

}
echo $result;

?>