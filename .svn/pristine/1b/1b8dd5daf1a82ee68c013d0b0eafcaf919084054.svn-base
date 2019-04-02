<?php
// $http_referer = $_SERVER['HTTP_REFERER'];
// if (empty($http_referer) || strpos($http_referer,'cnzhaoshu.com')===false) exit; 

require('db2.php');

$db = new db();
$result = $db->query('select shopid,name,count from v_flagshop order by shoporder');
unset($db);

echo json_encode($result);
?>