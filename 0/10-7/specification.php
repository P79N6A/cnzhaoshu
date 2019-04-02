<?php
// 根据关键词获取常用规格
require 'checkhost.php';
require 'db2.php' ;

$key = $_GET["key"];
$key = str_replace("蜡","腊",$key);
$key = str_replace("杆","干",$key);

$db = new db();
$result = $db->prepare_query('select * from keycount where word=?', array($key));
unset($db);

echo json_encode($result[0]); 

?>