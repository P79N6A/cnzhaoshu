<?php

require 'db.php';


$id = $_GET['id'];
$orderid = $_GET['orderid'];
$db = new db();

$sql = 'select a.price,b.name,b.phone,a.is_evaluate from (select price,userid,is_evaluate from bid_order where id=? and orderid=? and state != 0) a left join (select name,userid,phone from user) b on a.userid=b.userid';

$data = $db->prepare_query($sql,array($id,$orderid));

echo json_encode($data);
unset($db);
