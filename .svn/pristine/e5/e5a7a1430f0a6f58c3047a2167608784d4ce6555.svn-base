<?php 
include 'db2.php';

$userid = $_GET['userid'];
$limit = $_GET['limit'];

if($userid && $limit){
	$db = new db();
	$limit = explode(',', $limit);
	$sql = 'select a.*,b.name,b.dbh,b.dbh_type,b.crownwidth,b.height,b.price,b.height_type,b.age,b.branch_point_height,b.branch_bough_number,b.substrate,b.unit,b.userphone,b.username from (select * from order_one where userid=? and state < 10) a left join (select treeid,name,dbh,dbh_type,crownwidth,height,height_type,age,price,branch_point_height,branch_bough_number,substrate,unit,userphone,username from v_tree) b on a.treeid=b.treeid order by a.orderstart_time desc limit ?,?';

	$result = $db->prepare_query($sql , array($userid,$limit[0],$limit[1]));

	echo json_encode($result);

	unset($db);	
}

