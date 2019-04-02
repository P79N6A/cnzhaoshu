<?php
require 'checkhost.php';
require 'db.php';

$where = $_GET['where'];

$db = new db();
$price = $db->averageprice($where);

if ( !$price['max'] && strpos($where,'"key"')>=0 ) {		
	$where = str_replace('"key"','"name"',$where);
	$price = $db->averageprice($where);
}

if ($price['max']) {
	$count = $db->histogram($where,$price['min'],$price['max']);
	$price['histogram'] = $count;
}else{
	$price['histogram'] = null;	
}

unset($db);

echo json_encode($price); 

?>