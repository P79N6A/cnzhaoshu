<?php 
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];
if ($userid) {
	$db = new db();	
	$sql = 'select today, today_collect, allcollect, today_visit, allvisit, today_share, allshare, today_mycollect, allmycollect from zsq_record where userid=?'; //今天
	$result = $db->prepare_query($sql, array($userid))[0];
	unset($db);
	
	echo json_encode($result);
}


?>