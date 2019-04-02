<?php 
require 'checkhost.php';
require 'db2.php';

$db = new db();

$limit = $_GET['limit'];
$limit = explode(',', $limit);

$sql = 'select c.*,d.name tender_name,d.phone tender_phone from (select a.*,b.name bid_name,b.phone bid_phone from (select * from orders where deposit_switch = 2 and (order_switch = 1 or (state > 2 and fullamount > 0))) a left join (select userid,name,phone from user) b on a.bid_userid=b.userid) c left join (select userid,name,phone from user) d on c.tender_userid=d.userid order by c.orderstart_time desc limit ?,?';

$result = $db->prepare_query($sql,array($limit[0],$limit[1]));

echo json_encode($result);
 
unset($db);

