<?php
// 获取店铺所有荣耀资质图片
require 'checkhost.php';
require 'db2.php';


$userid = $_GET['userid'];
if($userid){
	$db = new db();
	// 苗店资质 
	$sql = 'select id,name from shop_honor where shopid=? order by time desc';
	$honor = $db->prepare_query( $sql, array($userid));

	unset($db);
}

echo json_encode($honor);


?>