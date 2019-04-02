<?php
require 'checkhost.php';
require 'db2.php';

$flagid = $_GET['platformid'];

$db = new db();	
$users = $db->prepare_query('select * from v_user where userstate=? order by grouporder', array($flagid));
unset($db);

echo json_encode($users);


?>