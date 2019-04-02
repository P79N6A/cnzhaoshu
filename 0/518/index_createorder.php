<?php  
include 'db2.php';

$db = new db();

$data = $_GET['data'];
$data = json_decode($data);

function get_total_millisecond(){  
	$date = date('ymdHis',time());
    $time = explode (" ", microtime () );   
    $time = 10000 + (int)($time [0] * 10000);
    return ($date . $time); 
}

$keys = array();
$values = array();
$truevalues = array();
foreach ($data as $key => $value) {
	array_push($keys, $key);
	array_push($values, '?');
	array_push($truevalues, $value);
}

array_push($keys, 'serial_number');
array_push($values, '?');
array_push($truevalues, get_total_millisecond());

$sql = 'insert into order_one('.join(',',$keys).') values('.join(',',$values).')';
$result = $db->prepare_insert($sql,$truevalues);

echo $result;


unset($db);