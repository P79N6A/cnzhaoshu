<?php 
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];

$db = new db();

$sql = 'select b.tree_name,b.state,b.tree_attribute,a.name,a.id from (select id,name from maps where userid=?) a left join maps_order b on a.id=b.map_id where b.state > 0';


$result = $db->prepare_query($sql,array($userid));

echo json_encode($result);

unset($db);



