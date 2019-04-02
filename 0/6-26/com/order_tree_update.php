<?php

require 'db2.php';


$id = $_GET['id'];
$userid = $_GET['userid'];
$data = $_GET['data'];
$data = json_decode($data,true);
$db = new db();

$arraykey = array();
$arrayvalue = array();

foreach ($data as $key => $value) {
	array_push($arraykey, $key.'=?');
	array_push($arrayvalue,$value);
}
array_push($arrayvalue,$id);
array_push($arrayvalue,$userid);

$sql = 'update tree_order set '.join(',',$arraykey).' where id=? and userid=?';

$result = $db->prepare_exec($sql,$arrayvalue);

echo $result;
unset($db);
