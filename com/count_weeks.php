<?php
// if ( empty($_SERVER['HTTP_REFERER']) || strtolower($_SERVER['SERVER_NAME'])!='cnzhaoshu.com') exit; 

require 'db_search.php';

$where = $_GET['where'];


$db = new db();
$result = $db->count_weeks($where);

// 只有key,且没有找到，找用户姓名
if ($result==null && strpos($where,'"key"')>=0) {
	$where = str_replace('"key"','"name"',$where);
	$result = $db->count_weeks($where);
}

$db = null;

echo json_encode($result); 
?>