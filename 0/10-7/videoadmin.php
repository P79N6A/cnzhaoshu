<?php
// 审核视频
require 'checkhost.php'; 
require 'db2.php';

$type = $_GET["type"];
$userid = $_GET["userid"];

$db = new db();

if ($type=='ok'){	
	$sqlList = array(
		array(
			'sql' => 'update user set video_checked=1 where userid=?',
			'parameter' => array($userid)
		),
		array(
			'sql' => 'update user set dianmi=dianmi+2 where userid=?',
			'parameter' => array($userid)
		)
	);

	$db->prepare_transaction($sqlList);
} else {
	$sql = 'update user set video=NULL where userid=?';
	$db->prepare_exec($sql, array($userid));
}

unset($db);

?>