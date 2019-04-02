<?php 
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];
if ($userid) {
	$db = new db();
	$sql = 'select name,phone,userid,shopid from user where userid=?';
	$result = $db->prepare_query($sql, array($userid));
	unset($db);

	echo json_encode($result[0]);
}

?>