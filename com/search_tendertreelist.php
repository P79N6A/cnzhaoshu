<?php 

require 'db.php';

$userid = $_GET['userid'];

$mapid = $_GET['mapid'];

$db = new db();

$sql = 'select * from map_tree where treeuserid=? and mapid=?';

$result = $db->prepare_query($sql,array($userid,$mapid));

echo json_encode($result);

unset($db);





 
