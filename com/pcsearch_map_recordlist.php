<?php
require 'checkhost.php';
require 'db2.php';

$db = new db();

$sql = 'select c.*,d.tree_name from (select a.* from maps_record a left join maps b on a.map_id = b.id order by a.time desc) c left join maps_order d on c.map_order_id = d.id group by c.map_order_id';
$result = $db->prepare_query($sql);

unset($db);
echo json_encode($result);
