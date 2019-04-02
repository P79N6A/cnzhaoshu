<?php 
require 'checkhost.php';
require 'db2.php';


$visitorid = $_GET['visitorid'];
$userid = $_GET['userid'];

if ($userid) {
	$db = new db();
	$sql = 'select visitorid,userid,name,time,type from v_shareinfo where visitorid=? and userid=?  order by time desc';
	$result = $db->prepare_query($sql, array($visitorid,$userid));
	unset($db);
	
	echo json_encode($result);
}

?>