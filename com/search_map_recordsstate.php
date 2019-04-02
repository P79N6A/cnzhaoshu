<?php 
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];

$db = new db();

$sql = 'select tree_name,state,tree_attribute from map_supervision where userid=? and switch=1 and state >0';

$result = $db->prepare_query($sql,array($userid));

echo json_encode($result);

unset($db);



