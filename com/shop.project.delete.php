<?php
// 删除旗舰店 精品项目
require 'checkhost.php';
require 'db2.php';


$id = $_POST['id'];
if ($id) {
	$db = new db();
	$sql = 'delete from shop_project where id=?';
	$result = $db->prepare_exec($sql , array($id));
	unset($db);
	
	unlink('../shop/project/o/'.$id.'.jpg');
	unlink('../shop/project/b/'.$id.'.jpg');
	unlink('../shop/project/m/'.$id.'.jpg');

	echo json_encode($result);
}


?>