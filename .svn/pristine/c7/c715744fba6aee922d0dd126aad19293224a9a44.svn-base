<?php
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];

if($userid){
	$db = new db();

	$sql = 'select a.*,b.num from (select * from maps where userid = ?) a left join (select count(id) num,map_id from maps_order group by map_id) b on a.id = b.map_id order by a.id desc';
	$result = $db->prepare_query($sql,array($userid));

	unset($db);
	echo json_encode($result);
}


