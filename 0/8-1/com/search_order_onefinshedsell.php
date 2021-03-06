<?php 
include 'db2.php';

$userid = $_GET['userid'];
$limit = $_GET['limit'];

if($userid && $limit){
	$db = new db();
	$limit = explode(',', $limit);
	$sql = 'select a.*,b.name,b.dbh,b.dbh_type,b.crownwidth,b.height,b.height_type,b.age,b.branch_point_height,b.branch_bough_number,b.substrate,b.unit from (select * from order_one where treeuserid=? and state = 4 order by id desc limit ?,?) a left join (select treeid,name,dbh,dbh_type,crownwidth,height,height_type,age,branch_point_height,branch_bough_number,substrate,unit from tree) b on a.treeid=b.treeid';

	$result = $db->prepare_query($sql , array($userid,$limit[0],$limit[1]));

	echo json_encode($result);

	unset($db);	
}

