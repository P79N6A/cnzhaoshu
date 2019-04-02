<?php 

require 'db2.php';

$userid = $_GET['userid'];

$db = new db();

$sql = 'select name,phone,isrenzheng from user where userid=?';

$result = $db->prepare_query($sql,array($userid))[0];

echo json_encode($result);

unset($db);