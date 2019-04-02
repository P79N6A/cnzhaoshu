<?php 

require 'db2.php';

$id = $_POST['id'];
$userid = $_POST['userid'];

$db = new db();

$sql = 'select groupuser from map_order where id=?';

$result = $db->prepare_query($sql,array($id))[0]['groupuser'];

$userids = explode(',', $result);
$nothas = true;
for ($i=0; $i < count($userids); $i++) { 
	if($userids[$i] == $userid){
		$nothas = false;
	}
}

if($nothas){
	if($result){
		$result = $result.','.$userid;
	}else{
		$result = $userid;
	}
		
	$sql = 'update map_order set groupuser = ? where id=?';

	$result = $db->prepare_exec($sql,array($result,$id));
	echo $result;
}else{
	echo '-1';
}
	


unset($db);

