<?php
// 店内苗木，置顶 或 取消置顶
require 'checkhost.php';
require 'db2.php';

$treeid = $_REQUEST['treeid'];
$type = $_REQUEST['type'];

if ($type=='top') {
	$sql = 'update tree set top=NOW() where treeid=?';
}else{
	$sql = 'update tree set top=NULL where treeid=?';
}


$db = new db();
$db->prepare_exec($sql, array($treeid));
unset($db);

echo $sql;
?>