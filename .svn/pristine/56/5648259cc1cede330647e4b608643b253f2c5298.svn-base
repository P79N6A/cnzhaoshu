<?php
	require 'db.php';
	$db = new db();

	$userid = $_GET['userid'];
	$name = $_GET['name'];
	$limit = $_GET['limit'];
	$limit = explode(',', $limit);

	if(is_numeric($name)){
		$sql = 'select a.*,b.username,b.phone from (select * from map_supervision where userid=?) a right join (select userid,name username,phone from user where phone like ?) b on a.tree_userid = b.userid where a.tree_name is not null order by a.id desc limit ?,?';
	}else{
		$sql = 'select a.*,b.username,b.phone from (select * from map_supervision where userid=? and tree_name like ?) a left join (select userid,name username,phone from user) b on a.tree_userid = b.userid order by a.id desc limit ?,?';
	}

	$result = $db->prepare_query($sql,array($userid,'%'.$name.'%',$limit[0],$limit[1]));

	unset($db);

	echo json_encode($result);