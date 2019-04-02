<?php
// require 'checkhost.php'; checkhost(); // 来路域名验证

require 'db.php';

$id = $_POST['id'];

if (isset($id)) {
	$db = new db();

	$sql = 'delete from evaluation where id=?';
	$result = $db->prepare_exec($sql, array($id));	

	unset($db);

	echo $result;
}

