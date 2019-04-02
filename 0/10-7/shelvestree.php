<?php
// 认证或取消认证树
require 'checkhost.php';
require 'db2.php';

$state = $_REQUEST['state'];
$treeid = $_REQUEST['treeid'];

if (isset($treeid)){
	$sql = 'update tree set state=? where treeid=?';
	$db = new db();
	$db->prepare_exec($sql, array($state, $treeid));
	unset($db);
}

?>