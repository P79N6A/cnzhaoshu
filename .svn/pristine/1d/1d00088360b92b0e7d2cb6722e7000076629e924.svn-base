<?php 
	require 'db.php';
	
	// 获取参数
	$limit = $_GET['limit'];
	$limit = explode(',', $limit);
	$db = new db();
	$sql = 'select a.*,user.name,user.phone from (select * from tree_order_index where state=1) a left join user on a.userid=user.userid order by a.time desc limit ?,?';
	$result = $db->prepare_query($sql,array($limit[0],$limit[1]));
	echo json_encode($result);
	unset($db);


























 ?>