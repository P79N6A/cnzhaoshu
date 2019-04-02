<?php
// 删除荣誉资质图片
require 'checkhost.php';
require 'db2.php';

$id = $_POST['id'];	

if ($id) {
	$db = new db();
	$sql = 'delete from shop_honor where id=?';
	$result = $db->prepare_exec($sql, array($id));
	unset($db);

	unlink('../shop/honor/o/'.$id.'.jpg');
	unlink('../shop/honor/b/'.$id.'.jpg');
	unlink('../shop/honor/m/'.$id.'.jpg');

	echo $result;
}

?>