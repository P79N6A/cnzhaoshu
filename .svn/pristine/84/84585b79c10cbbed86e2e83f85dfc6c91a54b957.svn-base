<?php
/**
* 添加树的访问记录,每颗树、每天、每个ip、每类型终端一次有效
* 事务处理：插入accesstree、tree.access++, user.treeaccess++
*/

require 'checkhost.php';
require 'db2.php';

$treeid = $_REQUEST["treeid"];
$shopid = $_REQUEST["shopid"];
$visitorid = $_REQUEST["userid"];
$type = $_REQUEST["type"];		// 0 mobile,1 website
$ip = $_SERVER["REMOTE_ADDR"];

$sqlList = array(
	array(
		'sql' => 'insert into accesstree(treeid,shopid,visitorid,ip,type,date) values (?,?,?,?,?,CURRENT_DATE())',
		'parameter' => array($treeid, $shopid, $visitorid, $ip, $type)
	),
	array(
		'sql' => 'update tree set access=access+1 where treeid=?',
		'parameter' => array($treeid)
	)
);

$db = new db();
$db->prepare_transaction($sqlList);
unset($db);

?>