<?php
require 'checkhost.php';
	require 'db2.php';

	$mapid = $_POST['mapid'];

	if($mapid){

		$db = new db();

		$sql = 'select * from maps_order where map_id =?';
		$result = $db->prepare_query($sql,array($mapid));

		if(!$result){
			$sql = 'delete from maps where id =?';
			$result = $db->prepare_exec($sql,array($mapid));
			echo $result;
		}
		unset($db);
	}