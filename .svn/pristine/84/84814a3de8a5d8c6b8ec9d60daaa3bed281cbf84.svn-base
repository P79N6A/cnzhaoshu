<?php 

require 'db.php';

$userid = $_GET['userid'];

$db = new db();

$sql = 'select e.*,f.name username,f.phone userphone from (select d.*,c.name projectname from (select id,userid,name from map where switch = 1 and userid=?) c left join (select a.*,b.name,b.number from (select * from map_order where userid=?) a left join (select * from map_tree) b on a.tree_id = b.id) d on c.id = d.mapid) e left join (select userid,name,phone from user) f on e.treeuserid = f.userid order by CONVERT(e.name USING gbk)';

$result = $db->prepare_query($sql,array($userid,$userid));

echo json_encode($result);

unset($db);








