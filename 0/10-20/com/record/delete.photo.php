<?php
/* 
删除养护日志照片
*/ 

// require '../checkhost.php'; // 来路域名验证
require '../db.php';

$id = explode('-', $_REQUEST['id']);
$recordid = $id[0];
$photo = $id[1];

$db = new db();

$sql = 'select photo from map_record where id=?';
$record = $db->prepare_query($sql, array($recordid))[0];

$photos = explode(';', $record['photo']);

foreach ($photos as $key => $value) {
	if ($value==$photo) {
		unset($photos[$key]);

		break;
	}
}

if (count($photos)) {
	$photos = join(';', $photos);
	$sql = 'update map_record set photo=? where id=?';
	$result = $db->prepare_exec($sql, array($photos, $recordid));
} else {
	// 没有图片了，删除
	$sql = 'delete from map_record where id=?';
	$result = $db->prepare_exec($sql, array($recordid));
}


if ($photo) {
	if (substr($photo, -1)=='v') {
		// 视频
		unlink($_SERVER['DOCUMENT_ROOT'].'/videos/'.$photo.'.jpg');
		unlink($_SERVER['DOCUMENT_ROOT'].'/videos/'.$photo.'.mp4');
	} else {
		// 图片
		unlink($_SERVER['DOCUMENT_ROOT'].'/photos/m/'.$photo.'.jpg');
		unlink($_SERVER['DOCUMENT_ROOT'].'/photos/o/'.$photo.'.jpg');

		// 检查并删除二维码
		$treeid = $_POST['treeid'];
		$tree = $db->prepare_query('select qrcode,photo from map_tree where id=? and find_in_set(\''.$photo.'\', photo)', array($treeid));
		if ($tree) {
			$tree = $tree[0];
	    	$qrcodes = explode(',', $tree['qrcode']);
	    	$photos = explode(',', $tree['photo']);

			foreach ($photos as $key => $value) {
				if ($value==$photo) {
					unset($photos[$key]);
					unset($qrcodes[$key]);

					break;
				}
			}

			$sql = 'update map_tree set qrcode=?, photo=? where id=?';
			$values = count($photos) ? array(join(',', $qrcodes), join(',', $photos), $treeid) : array(NULL, NULL, $treeid);
			$db->prepare_exec($sql, $values);

		}
	}
}

unset($db);
