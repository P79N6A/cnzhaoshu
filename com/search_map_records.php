<?php 
require 'checkhost.php';
require 'db2.php';
$userid = $_GET['userid'];
if(!$userid) exit;
$db = new db();

$sql = 'select a.id,a.tree_name,b.id recordid,b.userid,b.active,b.type,b.photo,b.gps,b.name,b.phone,b.time from (select id,tree_name from map_supervision where userid=? and switch=1) a left join (select c.* from (select id,userid,supervision_id,active,type,photo,gps,name,phone,time from map_records order by time desc) c group by c.supervision_id
) b on a.id = b.supervision_id where b.id is not null';
$result = $db->prepare_query($sql,array($userid));

echo json_encode($result);

unset($db);



