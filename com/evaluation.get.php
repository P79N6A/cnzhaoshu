<?php

require 'db.php';

$recordid = $_GET['recordid'];

if ($recordid) {
	$db = new db();

	$sql = 'select * from evaluation where treeid=? order by time asc';
	$result = $db->prepare_query($sql, array($recordid));

	if($result){

		for ($i=0; $i < count($result); $i++) { 
			$sql = 'select name from user where userid=?';
			$results = $db->prepare_query($sql, array($result[$i]['userid']));
			$result[$i]['username'] = $results[0]['name'];
		}
		
	}

	unset($db);

	echo json_encode($result);
}