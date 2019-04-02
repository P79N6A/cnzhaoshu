<?php 

require 'db.php';

$userid = $_GET['userid'];

$db = new db();

$sql = 'select b.name,b.userid,b.id from (select * from map_tree where treeuserid=? group by mapid) a left join (select * from map) b on a.mapid = b.id';

$result = $db->prepare_query($sql,array($userid));

echo json_encode($result);

unset($db);




