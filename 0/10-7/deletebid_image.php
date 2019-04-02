<?php 

	require 'checkhost.php';
	require 'db2.php';

	$imageid = $_POST['imageid'];
	$id = $_POST['id'];
	$userid = $_POST['userid'];
	$orderid = $_POST['orderid'];
	
	$db = new db();
	$sql = 'select image from bid_order where id=? and userid=? and orderid=?';
	$result = $db->prepare_query($sql,array($id,$userid,$orderid))[0]['image'];
	if($result){
		$imagename = explode(',', $result);
		$newname = '';
		foreach ($imagename as $key => $value) {
			if($value != $imageid){
				$newname .= $value.',';
			}
		}
		if($newname) $newname = rtrim($newname,',');
		$sql = 'update bid_order set image=? where id=? and userid=? and orderid=?';
		$result = $db->prepare_exec($sql,array($newname,$id,$userid,$orderid));

		if(file_exists('../bidimage/'.$imageid.'.jpg')){ 
		    unlink('../bidimage/'.$imageid.'.jpg'); 
		}
	}
	unset($db);
	echo $result;


 ?>