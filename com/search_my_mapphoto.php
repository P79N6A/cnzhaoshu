<?php
// 检查养护权限，是否同一个项目，同时获取养护区信息
require 'checkhost.php';
require 'db2.php';

$id = $_GET['id'];
$userid = $_GET['userid'];
$db = new db();

$sql = 'select tree_name,tree_attribute from maps_order where id=?';
$data = $db->prepare_query($sql,array($id))[0];


$sql = 'select id,map_id,map_order_id,active,type,photo,name,phone from maps_record where userid=? and map_order_id=? order by type desc';
$result = $db->prepare_query($sql,array($userid,$id))[0];

$data['record'] = $result;

unset($db);
echo json_encode($data);

