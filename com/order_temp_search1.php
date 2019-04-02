<?php 
	require('db.php');
	
	// 获取参数
	$userid = $_GET['uid'];
	!$userid && exit;

	$sql = 'select * from tree_order_temp where userid=?';
	$db = new db();
	$result = $db->prepare_query($sql, array($userid));
	$data = [];
	for ($i=0; $i < count($result); $i++) { 
		$data[$i] = [];
		$results = $result[$i];
		foreach ($results as $key => $value) {
			if($value){
				$data[$i][$key] = $value;
			}
		}
	}
	unset($db);
	echo json_encode($data);


























 ?>