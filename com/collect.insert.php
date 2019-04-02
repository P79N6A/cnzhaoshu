<?php 
	require('db.php');
	$db = new db();
	// 获取参数
	$where = $_GET['where'];
	if (isset($where)) {
		
		$data = json_decode($where, true);
		// 对数组进行处理
		$array_key = array();
		$array_value = array();
		$fileds_kay = array();
		// 将规格里的数组变为字符串
		foreach ($data as $key => $value) {
			array_push($array_key,$key);
			array_push($array_value,$value);
			array_push($fileds_kay,'?');
		}
		$sql = 'insert into collect('.join(',' , $array_key).') values('.join(',' , $fileds_kay).')';
		$result = $db->prepare_insert( $sql, $array_value );
		unset($db);
		echo $result;
	}

























 ?>