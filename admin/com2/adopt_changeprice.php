<?php 
require 'checkhost2.php';
require 'db3.php';
$data = $_POST['data'];

$data = json_decode($data,true);

if($user['role'] != 6) exit;

$db = new db();

$return = array();
for ($i=0; $i < count($data); $i++) { 
	$sql = 'update adopt_treeprice set price=? where id=?';
	$id = $db->prepare_exec($sql,array($data[$i]['price'],(int)$data[$i]['id']));
	$return[] = $id;
}

$result['return_code'] = '200';
$result['return_msg'] = '修改成功';
for ($i=0; $i < count($return); $i++) { 
	if(!$return[$i]){
		$result['return_code'] = '400';
		$result['return_msg'] = '修改失败';
	}
}

echo json_encode($result);
unset($db);