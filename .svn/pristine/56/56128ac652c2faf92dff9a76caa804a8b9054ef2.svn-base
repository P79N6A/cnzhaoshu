<?php 

require 'db2.php';

$userid = $_GET['userid'];

$db = new db();

$sql = 'select e.*,f.name tree_name,f.attribute,f.unit from (select c.*,d.name username,d.phone userphone from (select a.*,b.qrcode,b.x,b.y,b.address,b.name projectname,b.switch,b.create_time from (select q.*,w.time,w.active from (select * from map_order where treeuserid=?) q left join (select time,maporderid,active from map_record order by time desc) w on q.id=w.maporderid) a left join (select * from map) b on a.mapid = b.id group by a.id) c left join (select name,phone,userid from user) d on c.userid=d.userid) e left join (select * from map_tree) f on e.tree_id = f.id order by e.create_time desc ';

$data = $db->prepare_query($sql,array($userid));

echo json_encode($data);
unset($db);









