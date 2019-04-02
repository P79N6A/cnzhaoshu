<?php 
require 'checkhost.php';
require 'db2.php';

if($_GET['userid']){
	$limit = $_GET['limit'];
	$limit = explode(',', $limit);
	$sql = 'select userid,shopname,invoice from user where invoice=1 limit ?,?';

	$db = new db();
	$result = $db->prepare_query($sql,array($limit[0],$limit[1]));
	unset($db);
	
	echo json_encode($result);
}

?>