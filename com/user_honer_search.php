<?php

require 'db.php';

$userid = $_GET['userid'];
if ($userid) {
	// 养护员工
	$db = new db();

	$sql = 'select photo,photonames from user where userid=?';
	$result = $db->prepare_query($sql, array($userid));
	unset($db);
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
	if($data[0]){
		echo json_encode($data);
	}else{
		echo '0';
	}
}


?>