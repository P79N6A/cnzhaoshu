<?php
require 'checkhost.php';
require 'db2.php';

$id = $_GET['id'];
$limit = $_GET['limit'];
$begin = $_GET['begin'];
$end = $_GET['end'];
$userid = $_GET['userid'];


if($userid){
	$db = new db();
	$str = '';
	$dataarray = array();
	array_push($dataarray,$userid);

	if($id){
		$str = 'b.map_id=? ';
		array_push($dataarray,$id);
	} 

	if($begin && $id){
		$str .= 'and a.time >= ? and a.time <= ? ';
		$begin .= ' 00:00:00';
		$end .= ' 23:59:59';
		array_push($dataarray,$begin,$end);
	}elseif($begin){
		$str .= 'a.time >= ? and a.time <= ? ';
		$begin .= ' 00:00:00';
		$end .= ' 23:59:59';
		array_push($dataarray,$begin,$end);
	}

	if($str){
		$str = 'where '.$str;
	}

	$limit = explode(',', $limit);
	array_push($dataarray,$limit[0],$limit[1]);

	$sql = 'select a.id,b.tree_name,b.tree_attribute,a.active,a.type,a.photo,a.gps,a.name,a.phone,a.time from maps_record a left join (select o.id,o.tree_name,o.tree_attribute,o.map_id from maps m left join maps_order o on m.id = o.map_id where m.userid=?) b on a.map_order_id = b.id '.$str.'order by a.time desc limit ?,?';
	
	$result = $db->prepare_query($sql,$dataarray);

	unset($db);
	echo json_encode($result);
}

