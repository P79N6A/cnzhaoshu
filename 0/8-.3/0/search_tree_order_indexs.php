<?php 


require 'db2.php';

$db = new db();

$limit = $_GET['limit'];

$limit = explode(",", $limit);

$sql = 'select a.id,a.ordername,a.address,a.expiration_date,a.time,b.star from (select id,ordername,userid,address,expiration_date,time from tree_order_index where tendering = 1) a left join (select userid,star from user) b on a.userid = b.userid order by a.time desc limit ?,?';

$result = $db->prepare_query($sql , array($limit[0],$limit[1]));

unset($db);

echo json_encode($result);


 ?>