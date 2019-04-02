<?php
// require 'checkhost.php'; checkhost(); // 来路域名验证

require 'db.php';

$userid = $_GET['userid'];
$treeid = $_GET['recordid'];
$text = $_GET['text'];
$recorduserid = $_GET['recorduserid'];

if (isset($userid) && isset($treeid) && isset($text)) {
	$db = new db();

	$sql = 'insert into evaluation(treeid,userid,text) values(?,?,?)';
	$id = $db->prepare_insert($sql, array($treeid, $userid, $text));  // 返回生产的id

	unset($db);

	// if ($userid != $recorduserid) {
	// 	include 'message.evaluation.php';
	// 	sendMessage($flagid, $recorduserid, $text, $recordid);
	// }

	$result = array('time'=>$_GET['time'], 'id'=>$id);
	echo json_encode($result);
}

