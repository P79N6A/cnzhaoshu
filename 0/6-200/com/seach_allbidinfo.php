<?php

require 'db2.php';


$id = $_GET['id'];
$db = new db();

$sql = 'select a.price,b.name from (select price,userid from bid_order where id=? and state != 0) a left join (select name,userid from user) b on a.userid=b.userid';

$data = $db->prepare_query($sql,array($id));

echo json_encode($data);
unset($db);
