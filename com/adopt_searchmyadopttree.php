<?php 

require 'db.php';
$db = new db();

// $user = $_COOKIE['user2'];
$qrcode = $_GET['qrcode'];
$user['userid'] = 1;

// 判断这个码有没有人认养
$sql = 'select status,id from adopt_tree where qrcode=?';
$result = $db->prepare_query($sql,array($qrcode));

if($result[0]['status'] == 1){
	// 被认养
	$sql = 'select * from adopt_adopt where tree_id=? and userid=?';
	$result = $db->prepare_query($sql,array($result[0]['id'],$user['userid']));
	if(!$result){
		$return['return_code'] = '400';
		$return['return_msg'] = '此树已被人认养';
	}else{
		// 被我认养 续费
		$sql = 'select c.*,d.projectname from (select a.userid,a.id adopt_id,a.adopt_price,a.adopt_image,a.expiration_time,a.adopt_mark,a.status adopt_status,b.qrcode,b.id tree_id,b.tree_name,b.status tree_status,b.count,b.price,b.image,b.project_id from adopt_adopt a left join adopt_tree b on a.tree_id=b.id) c left join adopt_project d on c.project_id=d.id where (c.adopt_status=1 or c.tree_status=0) and c.qrcode=?';
		$result = $db->prepare_query($sql,array($qrcode));
		if($result){
			$return['return_code'] = '200';
			$return['return_msg'] = '续费查询成功';
			$return['return_data'] = $result[0];
		}
	}
}else if($result[0]['status'] == 0){
	// 未被认养 查出相关信息
	$sql = 'select a.*,a.id tree_id,b.projectname from adopt_tree a left join adopt_project b on a.project_id=b.id where a.qrcode=?';
	$result = $db->prepare_query($sql,array($qrcode));

	$sql = 'select username,phone,address from adopt_user where id=?';
	$userinfo = $db->prepare_query($sql,array($user['userid']));

	$data = $result[0];

	$return['return_code'] = '200';
	$return['return_msg'] = '未被认养查出成功';
	$return['return_data'] = $data;
}

	
echo json_encode($return);
unset($db);