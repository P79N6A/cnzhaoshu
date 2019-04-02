<?php
require 'checkhost.php';
require 'db.php';

$where = $_GET['where'];

$db = new db();
$result = $db->countProvince($where);

if ( $result==null && strpos($where,'"key"')>=0 ) {		
   $where = str_replace('"key"','"name"',$where);
   $result = $db->countProvince($where);
}

unset($db);

echo json_encode($result); 

?>