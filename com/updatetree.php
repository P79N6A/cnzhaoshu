<?php
// 修改苗木价格、数量、更新时间
require 'checkhost.php';
require 'db2.php';

$treeid = $_GET['treeid'];
$data = $_GET['data'];


$data = json_decode($data, true);

$fields = array('time=now()');
$sql_array = array();

foreach ($data as $key => $value) {
	$value = str_replace("\n", '，', $value);
	$value = str_replace("'", "’", $value);
	$value = str_replace('"', "’", $value);

	array_push($fields, $key.'=?');
	array_push($sql_array, $value);
}
$sql = 'update tree set '.join(',',$fields).' where treeid=?';

array_push($sql_array, $treeid);


$db = new db();
$db->prepare_exec($sql, $sql_array);
unset($db);

?>