<?php
	require 'checkhost.php';
	require 'db2.php';
	$db = new db();

	$userid = $_GET['userid'];
	$limit = $_GET['limit'];
	$limit = explode(',', $limit);

	$sql = 'select * from map_supervision where userid=? and tree_name is not null order by CONVERT(tree_name USING gbk) limit ?,?';

	$result = $db->prepare_query($sql,array($userid,$limit[0],$limit[1]));

	unset($db);

	echo json_encode($result);