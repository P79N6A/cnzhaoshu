<?php 
require 'checkhost.php';
require 'db2.php';

ignore_user_abort();
$oldtime=86400;

$url="http://cnzhaoshu.com/com/order_stop_timer.php";

$run = include './order_stoptimer.php';

if(!$run) die;

$db = new db();

$time = date('Y-m-d',time());

$sql = 'update tree_order_index set tendering = 2 where tendering = 1 and expiration_date < \''.$time.'\'';
$db->prepare_exec($sql);

sleep($oldtime);
file_get_contents($url);