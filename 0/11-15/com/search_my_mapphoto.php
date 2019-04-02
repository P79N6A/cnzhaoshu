<?php
// 检查养护权限，是否同一个项目，同时获取养护区信息
require 'checkhost.php';
require 'db2.php';

$id = $_GET['id'];
$userid = $_GET['userid'];
$db = new db();

$sql = 'select id,supervision_id,active,type,photo,name,phone from map_records where userid=? and supervision_id=? order by type desc';
$result = $db->prepare_query($sql,array($userid,$id))[0];

$info['records'] = $result;

unset($db);
echo json_encode($info);

