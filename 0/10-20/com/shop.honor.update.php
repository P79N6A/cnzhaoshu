<?php
// 更新荣誉资质图片的名称
require 'checkhost.php';
require 'db2.php';

$id = $_POST['id'];	
$name = $_POST['name'];	

if ($id) {
	$db = new db();
	$sql = 'update shop_honor set name=? where id=?';
	$result = $db->prepare_exec($sql, array($name, $id));
	unset($db);
	echo $result;
}

?>