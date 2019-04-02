<?php 

require 'db.php';

$userid = $_GET['userid'];
$begin = $_GET['begin'];
$end = $_GET['end'];

$db = new db();

$sql = 'select tree_name,state,tree_attribute from map_supervision where userid=? and switch=1 and (time >= ? and time <= ?)';

$result = $db->prepare_query($sql,array($userid,$begin,$end));

echo json_encode($result);

unset($db);



