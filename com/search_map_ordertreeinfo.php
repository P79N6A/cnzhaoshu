<?php 

require 'db.php';

$qrcodeid = $_GET['qrcodeid'];

$db = new db();

$sql = 'select e.*,f.name tree_name from (select c.*,d.tree_id,d.state from (select b.* from (select id from map) a left join (select id,userid,mapid,maporderid,active,photo,time,x,y from map_record) b on a.id = b.mapid where b.id is not null order by b.time desc) c left join (select tree_id,id,state from map_order where qxqrcode=?) d on c.maporderid = d.id where tree_id is not null group by c.maporderid) e left join (select name,id from map_tree) f on e.tree_id=f.id';

$result1 = $db->prepare_query($sql,array($qrcodeid));

$sql = 'select g.*,h.name tree_name,h.attribute,h.unit from(select e.*,f.tree_id,f.number,f.state from (select c.*,d.name username,d.phone from (select b.*,a.name projectname,a.address from (select * from map) a right join (select id,userid,mapid,maporderid,active,photo,time,x,y from map_record) b on a.id = b.mapid) c left join (select userid,name,phone from user) d on c.userid = d.userid) e left join (select tree_id,number,state,id from map_order where qxqrcode=?) f on e.maporderid = f.id where tree_id is not null) g left join (select name,id,attribute,unit from map_tree) h on g.tree_id=h.id where g.id is not null order by g.time desc';
$result2 = $db->prepare_query($sql,array($qrcodeid));

$result = array();
$result['mapphoto'] = $result1;
$result['photo'] = $result2;
echo json_encode($result);

unset($db);
