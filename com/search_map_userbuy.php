<?php 

require 'db2.php';

$userid = $_GET['userid'];

$db = new db();

$sql = 'select e.*,f.name tree_name,f.attribute,f.unit from (select c.*,d.name username,d.phone userphone from (select b.id,b.treeuserid,b.tree_id,b.number,b.active,b.state,b.time,a.userid,a.id mapid,a.qrcode,a.x,a.y,a.address,a.name projectname,a.switch,a.create_time from (select * from map where userid=?) a left join (select q.*,w.time,w.active from (select * from map_order) q left join (select time,maporderid,active from map_record order by time desc) w on q.id=w.maporderid group by q.id) b on a.id=b.mapid) c left join (select name,phone,userid from user) d on c.treeuserid = d.userid) e left join (select * from map_tree) f on e.tree_id = f.id order by e.create_time desc';
$data = $db->prepare_query($sql,array($userid));
echo json_encode($data);
unset($db);



