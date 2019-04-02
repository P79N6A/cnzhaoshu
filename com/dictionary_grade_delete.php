<?php
// 属性字典 删除
require 'checkhost.php';
require 'db2.php';

$id = $_REQUEST['id'];	

$sql = 'delete from dictionary_grade where id=?';

$db = new db();
$db->prepare_exec( $sql, array( $id ) );
unset($db);

?>