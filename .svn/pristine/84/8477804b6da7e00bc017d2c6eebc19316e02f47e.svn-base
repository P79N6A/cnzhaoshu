<?php
// 获取苗店苗木，如果是自己的苗店包括全部数据
require 'checkhost.php';
require 'db2.php';

$state = isset($_REQUEST['isMine']) ? '' : ' and state>0';
$sql = 'select userid,shopid,top,username,userphone,userrole,userstate,treeid,qrcodeid,imgpath,name,ldname,pname,dbh,crownwidth,height,dbh_type,height_type,branch_point_height,branch_bough_number,age,unit,substrate,remark,price,count,x,y,province,district,collections,video,phototime,photogps,state,invoice,time from v_tree where shopid=?'.$state.' order by top desc, CONVERT(name USING gbk),price desc';

$db = new db();
$result = $db->prepare_query($sql, array($_REQUEST['shopid']));
unset($db);

echo json_encode($result);