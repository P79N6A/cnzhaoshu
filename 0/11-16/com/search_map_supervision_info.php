<?php
	require 'checkhost.php';
	require 'db2.php';

	$db = new db();

	$id = $_GET['id'];

	$sql = 'select name,phone from user where userid=(select userid from map_supervision where id=?)';

	$result = $db->prepare_query($sql,array($id))[0];

	unset($db);
	
	echo json_encode($result);
