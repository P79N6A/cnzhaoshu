<?php 

require 'db2.php';

$id = $_GET['id'];
$ispurchaser = $_GET['ispurchaser'];

$db = new db();

$sql = 'select g.*,h.name tree_name,h.attribute,h.unit from(select e.*,f.tree_id,f.number,f.state from (select c.*,d.name username,d.phone from (select b.*,a.name projectname,a.address from (select * from map) a right join (select id,userid,mapid,maporderid,active,photo,time,x,y from map_record where maporderid=?) b on a.id = b.mapid) c left join (select userid,name,phone from user) d on c.userid = d.userid) e left join (select tree_id,number,state,id from map_order) f on e.maporderid = f.id) g left join (select name,id,attribute,unit from map_tree) h on g.tree_id=h.id where g.id is not null order by g.time desc';
$data = $db->prepare_query($sql,array($id));

echo json_encode($data);
unset($db);








