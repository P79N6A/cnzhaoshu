<?php
require 'checkhost.php';
require 'db2.php';

$db = new db();

$sql = 'select a.*,b.num from maps a left join (select count(id) num,map_id from maps_order group by map_id) b on a.id = b.map_id order by a.id desc';
$result = $db->prepare_query($sql);
unset($db);
echo json_encode($result);



