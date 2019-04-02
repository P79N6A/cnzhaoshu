<?php

require 'db.php';

$userid = $_GET['userid'];
$where = $_GET['where'];
if ($userid) {
	// 养护员工
	$db = new db();
	$wheres = json_decode($where, true);
	$photo = $wheres['photo'];
	$photonames = $wheres['photonames'];
	$sql = 'update user set photo=?,photonames =? where userid=?';

	$result = $db->prepare_exec($sql, array($photo,$photonames,$userid));
	unset($db);
	echo json_encode($result);
}


?>