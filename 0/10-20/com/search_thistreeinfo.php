<?php 
require 'checkhost.php';
require 'db2.php';

$db = new db();

$treeid = $_GET['treeid'];

$sql = 'select treeid,userid,imgpath,name,dbh,dbh_type,crownwidth,height,height_type,age,branch_point_height,branch_bough_number,substrate,price,count,unit,type,x,y,province,city,district,address,shopid,username,userphone from v_tree where treeid=?';

$result = $db->prepare_query($sql,array($treeid))[0];

unset($db);

echo json_encode($result);




