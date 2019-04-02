<?php 

require 'db.php';
$db = new db();

// $user = $_COOKIE['user2'];

// adopt_adopt 联合 adopt_tree 联合 adopt_project
$sql = 'select c.*,d.projectname from (select a.id,a.userid,a.adopt_price,a.adopt_image,a.adopt_mark,a.expiration_time,a.adopt_time,a.status,b.qrcode,b.tree_name,b.gps,b.image,b.count,b.project_id,b.id tree_id from adopt_adopt a left join adopt_tree b on a.tree_id=b.id) c left join adopt_project d on c.project_id=d.id where c.userid=? order by c.adopt_time desc';

// $result = $db->prepare_query($sql,array($user['userid']));
$result = $db->prepare_query($sql,array(1));
if($result){
	$return['return_code'] = '200';
	$return['return_msg'] = '成功';
	$return['return_data'] = $result;
}else{
	$return['return_code'] = '201';
	$return['return_msg'] = '无数据';
}
	
echo json_encode($return);
unset($db);