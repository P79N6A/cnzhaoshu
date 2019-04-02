<?php

include 'basic.php';
include 'db.php';
$db = new db();
$image = $_FILES['file'];
$userid = $_GET['userid'];
$treeid = $_GET['treeid'];


$updir = '../uploadmessage/image/';
//随机生成文件名称

$newname = time().rand(10000,99999).'.jpg';

$path = $updir.$newname;


if(move_uploaded_file($image['tmp_name'],$path)){
	
	$date = ['code'=>0,'msg'=>'','data'=>[]];
	$sql = 'insert into evaluation(userid,treeid,text) values(?,?,?)';

	$result = $db->prepare_insert( $sql, array($userid , $treeid , $newname) );

	if($result){
		$date['data']['src'] = '/uploadmessage/image/'.$newname;
	}
}else{
	$date = ['code'=>1,'msg'=>'图片上传失败!','data'=>[]];
}

unset($db);
echo json_encode($date);



