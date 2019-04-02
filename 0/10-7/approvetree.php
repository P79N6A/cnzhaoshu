<?php
// 管理员审核苗木
require 'checkhost.php';
require 'db.php';

$treeid = $_GET['treeid'];

if (isset($treeid)){
	// 审核苗木
	$db = new db();
	
	$sql = 'update tree set state=1,time=now() where treeid=?';
	$db->prepare_exec($sql, array($treeid));

	// 创建均价文件
	$price = $db->averageprice(null);
	$count = $db->histogram(null,$price['min'],$price['max']);
	$price['histogram'] = $count;
	file_put_contents('../data/a.json', json_encode($price));

	// 创建省份
	$province = $db->countProvince(null);
	file_put_contents('../data/p.json', json_encode($province));

	unset($db);
}

?>