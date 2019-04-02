<?php 
require 'checkhost.php';
require 'db2.php';


$userid = $_GET['userid'];
$limit = $_GET['limit'];
$limit = explode(',',$limit);

if ($userid) {
	$db = new db();

	$sql = 'select a.name,a.userid,a.time,b.shopid,b.useridb from v_mycollectinfo a,(select useridb,shopid,max(time) max_time from v_mycollectinfo where useridb=? group by shopid) b where a.shopid = b.shopid and a.time = b.max_time  order by b.max_time desc limit ?,?';
	$result = $db->prepare_query($sql, array($userid,$limit[0],$limit[1]));
	
	unset($db);

	echo json_encode($result);
}
?>