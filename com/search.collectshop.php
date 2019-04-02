<?php 
require 'checkhost.php';
require 'db2.php';


$shopid = $_GET['shopid'];
$limit = $_GET['limit'];
$limit = explode(',',$limit);
if ($shopid) {
	$db = new db();

	$sql = 'select a.userid,a.name,a.time from v_collectorinfo a,(select userid,shopid,max(time) max_time from v_collectorinfo where shopid=? group by userid) b where a.userid = b.userid and a.time = b.max_time  order by b.max_time desc limit ?,?';
	$result = $db->prepare_query($sql, array($shopid,$limit[0],$limit[1]));
	unset($db);

	echo json_encode($result);
	
}

?>