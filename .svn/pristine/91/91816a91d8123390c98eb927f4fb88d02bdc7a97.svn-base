<?php 
require 'checkhost.php';
require 'db2.php';

$phone = $_GET['phone'];
$userid = $_GET['userid'];

if($userid){
    $db = new db();
    $sql = 'update user set phone=? where userid=?';
    $result = $db->prepare_exec($sql , array($phone , $userid));
    unset($db);
    echo $result;
}