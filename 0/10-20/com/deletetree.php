<?php
// 删除苗木，同时删除找树车的苗木
require 'checkhost.php';
require 'db2.php';

$treeid = $_GET['treeid'];

$sqlList = array(
	array(
		'sql' => 'delete from tree where treeid=?',
		'parameter' => array($treeid)
	),
	array(
		'sql' => 'delete from mytree where treeid=?',
		'parameter' => array($treeid)
	)
);

$db = new db();
$db->prepare_transaction($sqlList);
unset($db);

?>