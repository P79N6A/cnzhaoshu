<?php

include 'db2.php';

$db = new db();
$get_msg = $_GET['get_msg'];
$userid = $_GET['userid'];
$sql = 'update user set get_msg=? where userid=?';
$result = $db->prepare_exec($sql , array($get_msg,$userid));
echo $result;

unset($db);



