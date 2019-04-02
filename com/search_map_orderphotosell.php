<?php 

require 'db2.php';

$userid = $_GET['userid'];

$db = new db();

$sql = 'select g.*,h.name tree_name from(select e.*,f.tree_id,f.state from (select b.*,a.x,a.y,a.userid from (select * from map) a right join (select id,mapid,maporderid,active,photo,time from map_record where userid=?) b on a.id = b.mapid where b.id is not null order by b.time desc) e left join (select tree_id,id,state from map_order) f on e.maporderid = f.id) g left join (select name,id from map_tree) h on g.tree_id=h.id group by g.maporderid order by g.time desc';
$data1 = $db->prepare_query($sql,array($userid));

$sql = 'select e.*,f.name tree_name,f.attribute,f.unit from (select c.*,d.name username,d.phone userphone from (select a.*,b.qrcode,b.x,b.y,b.address,b.name projectname,b.switch,b.create_time from (select q.*,w.time,w.active from (select * from map_order where treeuserid=? or groupuser like ?) q left join (select time,maporderid,active from map_record order by time desc) w on q.id=w.maporderid) a left join (select * from map) b on a.mapid = b.id group by a.id) c left join (select name,phone,userid from user) d on c.userid=d.userid) e left join (select * from map_tree) f on e.tree_id = f.id order by e.create_time desc';

$data2 = $db->prepare_query($sql,array($userid,'%'.$userid.'%'));

$data = array();

$data['photo'] = $data1;
$data['project'] = $data2;

echo json_encode($data);
unset($db);









