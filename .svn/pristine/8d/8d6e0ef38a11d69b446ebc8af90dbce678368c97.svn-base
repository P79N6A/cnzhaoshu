<?php 
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];
$limit = $_GET['limit'];

$limit = explode(',', $limit);

$db = new db();

$sql = 'select g.*,h.name tree_name,h.attribute,h.unit from(select e.*,f.tree_id,f.number,f.state from (select c.*,d.name username,d.phone from (select b.*,a.name projectname,a.address from (select * from map) a left join (select id,userid,mapid,maporderid,active,photo,time,x,y from map_record) b on a.id = b.mapid where a.userid=? and b.id is not null order by b.time desc) c left join (select userid,name,phone from user) d on c.userid = d.userid) e left join (select tree_id,number,state,id from map_order) f on e.maporderid = f.id) g left join (select name,id,attribute,unit from map_tree) h on g.tree_id=h.id order by g.time desc limit ?,?';
$data = $db->prepare_query($sql,array($userid,$limit[0],$limit[1]));

echo json_encode($data);
unset($db);









