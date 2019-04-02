<?php
// 删除苗木，同时删除找树车的苗木
require 'checkhost.php';
require 'db2.php';

$treeid = $_GET['treeid'];

$db = new db();

// 准备删除图片
$tree = $db->prepare_query('select imgpath,video from tree where treeid=?', array($treeid))[0];

$sqlList = array(
	array(
		'sql' => 'delete from tree where treeid=?',
		'parameter' => array($treeid)
	),
	array(
		'sql' => 'delete from mytree where treeid=?',
		'parameter' => array($treeid)
	)
);


if ($db->prepare_transaction($sqlList)) {
	include 'basic.php';

	if ($tree['video']) {
		unlink($_SERVER['DOCUMENT_ROOT'].'/trees/video/'.$tree['video'].'.jpg');
		unlink($_SERVER['DOCUMENT_ROOT'].'/trees/video/'.$tree['video'].'.mp4');
	}

	if ($tree['imgpath']) 
	foreach (explode(';', $tree['imgpath']) as $key => $imgpath) {
		$imgpath = basic::decode($imgpath);

		unlink($_SERVER['DOCUMENT_ROOT'].'/trees/o2/'.$imgpath.'.jpg');
		unlink($_SERVER['DOCUMENT_ROOT'].'/trees/b2/'.$imgpath.'.jpg');
		unlink($_SERVER['DOCUMENT_ROOT'].'/trees/s2/'.$imgpath.'.jpg');
		unlink($_SERVER['DOCUMENT_ROOT'].'/trees/m/'.$imgpath.'.jpg');

	}
}
unset($db);

?>