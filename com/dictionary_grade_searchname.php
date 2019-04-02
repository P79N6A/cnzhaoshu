<?php
// 查询属性字典


require('db.php');

$name = $_REQUEST['name'];	

$sql = 'select * from dictionary_grade where name like \''.$name.'\'';

$db = new db();
$result = $db->query($sql);
unset($db);

echo json_encode($result);

?>

