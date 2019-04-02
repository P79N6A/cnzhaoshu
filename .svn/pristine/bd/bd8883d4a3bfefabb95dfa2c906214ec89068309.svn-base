<?php
// 查询属性字典
require 'checkhost.php';
require 'db2.php';

$db = new db();
$result = $db->query('select name,attribute from dictionary_attribute where name in ('.$_REQUEST['names'].')');
unset($db);

echo json_encode($result);

?>