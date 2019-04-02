<?php
// 查询 等级字典
require 'checkhost.php';
require 'db2.php';

$name = $_REQUEST['name'];	

$db = new db();

if ($name) {
	$sql = 'select * from dictionary_grade where name like ?';
	$result = $db->prepare_query($sql, array('%'.$name.'%'));
} else {
	$result = $db->query('select * from dictionary_grade order by CONVERT(name USING gbk)');
}

unset($db);

echo json_encode($result);

?>