<?php
// 检查养护权限，是否同一个项目，同时获取养护区信息
// require '../checkhost.php'; // 来路域名验证
require '../db.php';
require 'record.php';


$maporderid = $_GET['maporderid'];
$type = $_GET['type'];

$db = new db();

if ($type) {
	// $record = $db->prepare_query('SELECT * FROM map_record WHERE maporderid=? and type=?', array($maporderid, $type));
	$record = record::search(array('maporderid'=>$maporderid, 'type'=>$type));

	$result = $record ? $record[0] : null;
} else {
	$tree = $db->prepare_query('SELECT * FROM v_map_order WHERE maporderid=?', array($maporderid));
	// $record = $db->prepare_query('SELECT * FROM map_record WHERE maporderid=? order by time desc', array($maporderid));
	$record = record::search(array('maporderid'=>$maporderid));

	$result = array('tree'=>$tree ? $tree[0] : null, 
		            'record'=>$record ? $record[0] : null);
}

unset($db);


echo json_encode($result);