<?php 
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];
$limit = $_GET['limit'];
$limit = explode(',',$limit);
if ($userid) {
	$db = new db();
	$sql = 'select b.visitorid userid,a.name,a.date time,a.type from v_visitinfo a,(select visitorid,userid,max(date) max_time from v_visitinfo where userid=? group by visitorid) b where a.visitorid = b.visitorid and a.date = b.max_time group by b.visitorid order by b.max_time desc limit ?,?';
	$result = $db->prepare_query($sql, array($userid,$limit[0],$limit[1]));
	unset($db);

	echo json_encode($result);
}
?>