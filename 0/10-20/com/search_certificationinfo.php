<?php 
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];

$db = new db();
if($userid != 1) exit;
$sql = 'select name,phone,isrenzheng,rz_time,userid from user where isrenzheng > 2';

$result = $db->prepare_query($sql);

echo json_encode($result);

unset($db);