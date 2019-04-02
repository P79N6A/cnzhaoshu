<?php
// 属性字典 删除
require 'checkhost.php';
require 'db2.php';

$name = $_REQUEST['name'];	

$sql = 'delete from dictionary_attribute where name=?';

$db = new db();
$db->prepare_exec( $sql, array( $name ) );
unset($db);

?>