<?php
// 检查养护权限，是否同一个项目，同时获取养护区信息
require 'checkhost.php';
require 'db2.php';

$id = $_GET['id'];
$userid = $_GET['userid'];
$type = $_GET['type'];
$db = new db();

$sql = 'select id,map_id,map_order_id,active,type,photo,name,phone from maps_record where userid=? and map_order_id=? and type=?';
$result = $db->prepare_query($sql,array($userid,$id,$type))[0];

unset($db);
echo json_encode($result);

