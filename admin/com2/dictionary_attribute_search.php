<?php
// 查询属性字典
require 'checkhost2.php';
require 'db3.php';

$db = new db();

$result = $db->query('select * from dictionary_attribute order by CONVERT(name USING gbk)');

unset($db);

echo json_encode($result);

?>