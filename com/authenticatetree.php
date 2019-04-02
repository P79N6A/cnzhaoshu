<?php
// 认证或取消认证树，2认证 1 取消认证
require 'checkhost.php';
require 'db2.php';

$userid = $_REQUEST['userid'];
$state = $_REQUEST['state'];
$treeid = $_REQUEST['treeid'];

$sql = $state==2 ? 'update tree set state=4, approveuserid=? where treeid=?'
				 : 'update tree set state=1, unapproveuserid=? where treeid=?';
$db = new db();
$db->prepare_exec($sql, array($userid, $treeid));
unset($db);

?>