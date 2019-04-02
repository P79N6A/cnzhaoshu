<?php 

require 'checkhost.php';
require 'db2.php';

ignore_user_abort();
$oldtime=60;

$url="http://cnzhaoshu.com/com/orders_makerecept.php";

$run = include './orders_recepttimer.php';

if(!$run) die;

$db = new db();

$time = date('Y-m-d H:i:s',strtotime('-5 day'));

$sql = 'update orders set order_switch = 9 where delivery_time < \''.$time.'\'';
$db->prepare_exec($sql);

$sql = 'update order_one set order_switch = 9 where delivery_time < \''.$time.'\'';
$db->prepare_exec($sql);

sleep($oldtime);
file_get_contents($url);