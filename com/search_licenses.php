<?php 
require 'checkhost.php';
require 'db2.php';

if($_GET['search']){
	$search = $_GET['search'];
	$sql = 'select userid,shopname,invoice from user where invoice > 0 and (name like ? or shopname like ? or phone like ?)';
	$searching = '%'.$search.'%';

	$db = new db();
	$result = $db->prepare_query($sql,array($searching,$searching));
	unset($db);

	echo json_encode($result);
}

?>