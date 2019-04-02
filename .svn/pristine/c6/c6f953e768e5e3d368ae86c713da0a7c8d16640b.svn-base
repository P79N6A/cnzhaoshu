<?php
	require 'db.php';
	$db = new db();

	$userid = $_GET['userid'];
	$name = $_GET['name'];
	$limit = $_GET['limit'];
	$limit = explode(',', $limit);

	$array = ['号树','挖树','上车','运输','卸车'];

	if(in_array($name, $array)){
		$sql = 'select * from map_supervision where userid=? and state=? and switch=1 order by CONVERT(tree_name USING gbk) limit ?,?';
		$result = $db->prepare_query($sql,array($userid,$name,$limit[0],$limit[1]));
	}else{
		$sql = 'select * from map_supervision where userid=? and tree_name like ? and switch=1 order by id asc limit ?,?';
		$result = $db->prepare_query($sql,array($userid,'%'.$name.'%',$limit[0],$limit[1]));
	}


	unset($db);

	echo json_encode($result);