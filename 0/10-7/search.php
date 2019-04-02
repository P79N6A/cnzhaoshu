<?php
// 按条件综合查询苗木
require 'checkhost.php';
require 'db.php';

$where = $_GET['where'];
$limit = $_GET['limit'];
$fromWhere = empty($_GET['fromWhere']) ? 1 : 0; // 0 PC,1 mobile,2 wechat

if (empty($where) && empty($limit)) {
	echo null;
}else{
	$db = new db();
	$result = $db->search($where,$limit,$fromWhere);

	// 只有key,且没有找到，找用户姓名，没有规格
	// if ( $result==null && strpos($where,'"key"')>=0 
		// && strpos($where,'dbh')===false && strpos($where,'crownwidth')===false && strpos($where,'height')===false ) {		
	if ( $result==null && strpos($where,'"key"')>=0 ) {		
		$where = str_replace('"key"','"name"',$where);
		$result = $db->search($where,$limit,$fromWhere);
	}

	unset($db);
	
	echo json_encode($result); 
}