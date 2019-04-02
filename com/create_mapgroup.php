<?php 
require 'checkhost.php';
require 'db2.php';
require 'qrcode.create.php';
ini_set('display_errors','on');

$userid = $_GET['userid'];

$qrcodeid = $_GET['qrcodeid'];

$db = new db();

$sql = 'select * from map_group where userid = ?';

$result = $db->prepare_query($sql,array($userid));

if(!$result){
    $sql = 'insert into map_group(userid,qxuserid) values(?,?)';
    $result = $db->prepare_insert($sql,array($userid,$qrcodeid));

    $qrcode = QRcodeCreate::mapgroupqrcode($userid);
    $filename = '../mapgroupqrcode/'.$userid.'.png';
    imagepng($qrcode, $filename);
}else{
    $sql = 'update map_group set qxuserid=? where userid=?';
    $result = $db->prepare_exec($sql,array($qrcodeid,$userid));
}

echo $result;

unset($db);