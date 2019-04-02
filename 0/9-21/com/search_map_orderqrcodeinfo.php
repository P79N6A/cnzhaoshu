<?php 

require 'db2.php';

$qrcodeid = $_GET['qrcodeid'];

$db = new db();

$sql = 'select g.*,h.address,h.projectname from (select e.*,f.treeusername,f.treeuserphone from (select c.*,d.username,d.userphone from (select a.userid,a.treeuserid,a.number,a.id,a.mapid,b.name treename,b.attribute,b.unit from (select treeuserid,tree_id,number,userid,mapid,id from map_order where qxqrcode=?) a left join (select name,attribute,unit,id from map_tree) b on a.tree_id = b.id) c left join (select name username,phone userphone,userid from user) d on c.userid = d.userid) e left join (select name treeusername,phone treeuserphone,userid from user) f on e.treeuserid = f.userid) g left join (select id,address,name projectname from map) h on g.mapid=h.id';

$result = $db->prepare_query($sql,array($qrcodeid))[0];

echo json_encode($result);

unset($db);

