<?php
	require 'db.php';
	$db = new db();

	$userid = $_GET['userid'];
	$limit = $_GET['limit'];
	$limit = explode(',', $limit);

	$sql = 'select a.*,b.username,b.phone from (select * from map_supervision where userid=?) a left join (select userid,name username,phone from user) b on a.tree_userid = b.userid order by a.id desc limit ?,?';

	$result = $db->prepare_query($sql,array($userid,$limit[0],$limit[1]));

	unset($db);

	echo json_encode($result);