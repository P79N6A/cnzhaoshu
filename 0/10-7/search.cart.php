<?php
// 获取购物车苗木
require 'checkhost.php';
require 'db2.php';

$sql = 'select shopid,username,userphone,userrole,userstate,treeid,qrcodeid,imgpath,name,ldname,pname,dbh,crownwidth,height,dbh_type,height_type,branch_point_height,branch_bough_number,age,unit,substrate,remark,price,count,x,y,province,district,collections,video,phototime,photogps,state,invoice,time from v_mytree where userid=? and state>0 order by CONVERT(name USING gbk),price desc';

$db = new db();
$result = $db->prepare_query($sql, array($_REQUEST['userid']));
unset($db);

echo json_encode($result);