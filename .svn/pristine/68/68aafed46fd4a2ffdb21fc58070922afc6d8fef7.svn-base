<?php 

require 'db.php';

$db = new db();

$sql = 'select c.*,d.name userid_name,d.phone userid_phone from (select a.*,b.name treeuserid_name,b.phone treeuserid_phone from (select order_switch_time,treeuserid,userid,deposit,fullamount,state,order_switch_remark,treeid,serial_number from order_one where order_switch=9 order by order_switch_time desc) a left join (select userid,name,phone from user) b on a.treeuserid=b.userid) c left join (select userid,name,phone from user) d on c.userid=d.userid';

$data = $db->query($sql);

echo json_encode($data);

unset($db);

