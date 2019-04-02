<?php
$http_referer = $_SERVER['HTTP_REFERER'];
if (empty($http_referer) || strpos($http_referer,'cnzhaoshu.com')===false) exit; 

require('db2.php');

$type = $_REQUEST["type"];		
$userid = $_REQUEST["userid"];	

$table = $type=='find' ? 'v_mytree' : 'v_tree';
$treeuserid = $type=='find' ? 'treeuserid as userid,' : 'userid,';
$wherestate = $type=='find' ? 'state>0 and ' : '';

$sql = 'select '.$treeuserid.'username,userphone,userstate,treeid,imgpath,name,dbh,crownwidth,height,price,count,province,district,collections from '.$table.' where '.$wherestate.'userid='.$userid.' order by time desc';

$db = new db();
$result = $db->query($sql);
unset($db);

echo json_encode($result);
?>