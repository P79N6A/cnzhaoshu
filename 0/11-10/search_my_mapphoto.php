<?php
// 检查养护权限，是否同一个项目，同时获取养护区信息
// require '../checkhost.php'; // 来路域名验证
require 'db.php';

$id = $_GET['id'];
$userid = $_GET['userid'];
$db = new db();

$sql = 'select id,tree_name,tree_attribute from map_supervision where switch = 1 and qrcode = ?';
$info = $db->prepare_query($sql,array($id))[0];

$sql = 'select id,supervision_id,active,type,photo,name,phone from map_records where userid=? and supervision_id=? order by type desc';
$result = $db->prepare_query($sql,array($userid,$info['id']))[0];

$info['records'] = $result;

unset($db);
echo json_encode($info);

