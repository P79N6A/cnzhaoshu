<?php
// require 'checkhost.php';
require 'db2.php';

$db = new db();

$sql = 'select e.*,f.name from (select c.*,d.photo from ((select a.id,a.mapid,a.tree_id,b.qrcode,b.name treename from (map_order a left join map_tree b on a.tree_id=b.id) where b.qrcode is not null) c left join map_record d on c.id=d.maporderid) where d.photo is not null) e left join map f on e.mapid = f.id';
$result = $db->query($sql);

echo json_encode($result);

unset($db);

