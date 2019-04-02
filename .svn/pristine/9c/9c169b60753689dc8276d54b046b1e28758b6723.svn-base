<?php 

require 'db.php';
$db = new db();

$keyword = $_GET['keyword'];

$sql = "select c.*,d.username,d.phone from (select a.*,b.userid from adopt_tree a left join adopt_adopt b on a.id = b.tree_id) c left join adopt_user d on c.userid = d.id where c.qrcode like ? or d.username like ? or d.phone like ?";

$searching = '%'.$keyword.'%';
$result = $db->prepare_query($sql,array($searching,$searching,$searching));

if(count($result)){
	$return['return_code'] = '200';
	$return['return_msg'] = '查询成功';
	$return['return_data'] = $result;
}else{
	$return['return_code'] = '201';
	$return['return_msg'] = '未查询到相似结果';
}

echo json_encode($return);
unset($db);