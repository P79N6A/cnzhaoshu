<?php 
	require 'checkhost.php';
	require 'db2.php';
	
	// 获取参数
	$userid = $_GET['userid'];
	$db = new db();
	$sql = 'select * from tree_order_index where userid=? and state=1 and tendering <> 2 order by time desc';
	$result = $db->prepare_query($sql,array($userid));
	echo json_encode($result);
	unset($db);


























 ?>