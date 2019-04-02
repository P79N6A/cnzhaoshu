<?php
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];

if($userid){
	$db = new db();

	$sql = 'select * from maps where userid = ? order by create_time desc';
	$result = $db->prepare_query($sql,array($userid));

	unset($db);
	echo json_encode($result);
}

