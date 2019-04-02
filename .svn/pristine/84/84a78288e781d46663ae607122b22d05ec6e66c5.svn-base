<?php
require 'db.php';

ignore_user_abort();
set_time_limit(0);
$interval=86400;
do{	
	$db = new db();
	$time = date('Y-m-d');
	$sql = 'update tree_order_index set tendering=2 where expiration_date < ?';
	$db->prepare_exec($sql,array($time));
	unset($db);
	sleep($interval);
}while(true);

?>