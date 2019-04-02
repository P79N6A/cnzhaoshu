<?php

require 'db2.php';

$userid = $_GET['userid'];
$money = $_GET['money'];
$gift = $_GET['gift'];
$db = new db();

$sql = 'select virtual_money,real_money from user where userid=?';
$data = $db->prepare_query($sql,array($userid));

$virtual_money = $gift + $data[0]['virtual_money']*100;
$real_money = $money + $data[0]['real_money']*100;

$sql = 'update user set virtual_money=? , real_money=? where userid=?';
$result = $db->prepare_exec($sql,array($virtual_money,$real_money,$userid));

$sql = 'insert into recharge_bill(userid,money) values(?,?)';
$date = $db->prepare_insert($sql,array($userid,$money*100));

echo $result;

unset($db);
