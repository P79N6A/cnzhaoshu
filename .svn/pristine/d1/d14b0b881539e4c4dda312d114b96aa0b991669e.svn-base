<?php
require 'db2.php';
require 'user2.php';
require '../wechat/message.audit.php';

$userid = 811;

$user = user::getUserByUserId($userid);
$title = '审核提醒测试消息';
$keyword = '审核通过';
$remark = '备注信息';
$url = 'm.php'; // 不用写域名，没有不写即null

echo json_encode($user);

echo "$title, $keyword, $remark, $url";

sendMessage($user['wechatid'], $title, $keyword, $remark, $url);




?>