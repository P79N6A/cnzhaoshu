<?php
	require 'checkhost.php';
	require 'db2.php';

	$db = new db();

	$id = $_POST['id'];
	$name = $_POST['name'];
	$attribute = $_POST['attribute'];

	$sql = 'update map_supervision set tree_name=?,tree_attribute=? where id=?';

	$result = $db->prepare_exec($sql,array($name,$attribute,$id));

	unset($db);
	
	echo $result;
