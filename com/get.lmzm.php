<?php
require 'checkhost.php';
require 'db2.php';


$db = new db();	
$users = $db->query('select userid,name from user where state=1020 and to_days(scantime)=to_days(now()) order by scantime');
unset($db);

echo json_encode($users);


?>