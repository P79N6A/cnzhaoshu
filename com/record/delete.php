<?php
/* 
删除养护日志，同时删除照片
*/ 

// require '../checkhost.php'; // 来路域名验证
require '../db.php';

$recordid = $_POST['id'];

$db = new db();

$sql = 'select photo from map_record where id=?';
$record = $db->prepare_query($sql, array($recordid))[0];

$sql = 'delete from map_record where id=?';
$result = $db->prepare_exec($sql, array($recordid));

unset($db);

foreach (explode(';', $record['photo']) as $key => $photo) {
	if ($photo) {
		if (substr($photo, -1)=='v') {
			// 视频
			unlink($_SERVER['DOCUMENT_ROOT'].'/videos/'.$photo.'.jpg');
			unlink($_SERVER['DOCUMENT_ROOT'].'/videos/'.$photo.'.mp4');
		} else {
			// 图片
			unlink($_SERVER['DOCUMENT_ROOT'].'/photos/m/'.$photo.'.jpg');
			unlink($_SERVER['DOCUMENT_ROOT'].'/photos/o/'.$photo.'.jpg');
		}
	}
}

return $result;

