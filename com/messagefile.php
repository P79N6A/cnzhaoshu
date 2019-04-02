<?php

include 'basic.php';
include 'db.php';
$db = new db();
$file = $_FILES['file'];
$userid = $_GET['userid'];
$treeid = $_GET['treeid'];

$updir = '../uploadmessage/file/';
//随机生成文件名称


$newname = date('y-m-d h:i:s',time()).$file['name'];

$path = $updir.$newname;

if(move_uploaded_file($file['tmp_name'],$path)){
	
	$date = ['code'=>0,'msg'=>'','data'=>[]];
	$sql = 'insert into evaluation(userid,treeid,text) values(?,?,?)';

	$result = $db->prepare_insert( $sql, array($userid , $treeid , $newname) );

	if($result){
		$date['data']['src'] = '/uploadmessage/file/'.$newname;
		$date['data']['name'] = $newname;
	}
}else{
	$date = ['code'=>1,'msg'=>'文件上传失败!','data'=>[]];
}

unset($db);
echo json_encode($date);
