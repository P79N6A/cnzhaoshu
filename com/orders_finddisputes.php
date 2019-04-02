<?php 

require 'db2.php';

$db = new db();

$sql = 'select c.*,d.name tender_name,d.phone tender_phone from (select a.*,b.name bid_name,b.phone bid_phone from (select order_switch_time,bid_userid,tender_userid,state,deposit_switch,order_switch_remark,id,serial_number,deposit,fullamount,tree_order_id from orders where order_switch=9 order by order_switch_time desc) a left join (select userid,name,phone from user) b on a.bid_userid=b.userid) c left join (select userid,name,phone from user) d on c.tender_userid=d.userid';

$data = $db->query($sql);

echo json_encode($data);

unset($db);

