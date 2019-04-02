<?php
// 统计关键词搜索频次
require('db.php');
$db = new db();


$userid = $_GET['userid'];
if(!$userid) exit;	
$id = $_GET['id'];	
$sql = 'delete from shop_project where id=?';
$results = $db->prepare_exec($sql , array($id));
$path = '../shop/photo/c/'.$id.'.jpg';
unlink($path);
echo json_encode($results);

unset($db);



?>