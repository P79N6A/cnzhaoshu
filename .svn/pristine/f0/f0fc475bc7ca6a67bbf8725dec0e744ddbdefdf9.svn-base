<?php

include './basic.php';
require('db.php');
$db = new db();


$userid = $_GET['userid'];
$file = $_FILES['file'];
$filename=$file["tmp_name"];
$extend = pathinfo($file['name'],PATHINFO_EXTENSION);

switch($extend){
	case 'gif':
		$image = imagecreatefromgif($filename);
		break;
	case 'jpg':
		$image = imagecreatefromjpeg($filename);
		break;
	case 'png':
		$image = imagecreatefrompng($filename);
		break;
}


$name = time().rand(10000,99999);
$newpath = '../shop/photo/o/'.$name.'.jpg';
move_uploaded_file ($filename,$newpath);

$image1280 = basic::resizeImage($image, 1280, 1280);
$newpath = '../shop/photo/b/'.$name.'.jpg';
imagejpeg($image1280, $newpath, 80);


$image160 = basic::resizeImage($image, 160, 160);
$newpath = '../shop/photo/m/'.$name.'.jpg';
imagejpeg($image160, $newpath, 80);

unset($image1280);
unset($image160);


// 保存路径到数据库

$sql = 'select photo from user where userid = ?';
$result = $db->prepare_query( $sql, array($userid));

$honerimage = $result[0]['photo'];
if($honerimage){
	$honerimage = $honerimage.';'.$name;
}else{
	$honerimage = $name;
}
$sql = 'update user set photo=? where userid = ?';
$result = $db->prepare_exec( $sql, array($honerimage , $userid));

?>