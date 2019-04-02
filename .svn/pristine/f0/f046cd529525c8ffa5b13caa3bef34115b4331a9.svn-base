<?php 
require 'checkhost.php';
require 'db2.php';
require 'qrcode.create.php';


$userid = $_GET['userid'];

$qrcodeid = $_GET['qrcodeid'];

$db = new db();

$sql = 'select * from maps_group where userid = ?';

$result = $db->prepare_query($sql,array($userid));

if(!$result){
    $sql = 'insert into maps_group(userid,qxuserid) values(?,?)';
    $result = $db->prepare_insert($sql,array($userid,$qrcodeid));

    $qrcode = QRcodeCreate::mapgroupqrcode($userid);
    $filename = '../mapgroupqrcode/'.$userid.'.png';
    imagepng($qrcode, $filename);
}else{
    $sql = 'update maps_group set qxuserid=? where userid=?';
    $result = $db->prepare_exec($sql,array($qrcodeid,$userid));
}

echo $result;

unset($db);