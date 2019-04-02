<?php
// 批量更新开放平台菜单，未认证公众号设置菜单无效
header("Content-type: text/html;charset=utf-8");

require '../com/db2.php';
require '../com/basic.php';

$db = new db();
$users = $db->query('select userid,phone from user');

foreach ($users as $user) {
  $phone = $user['phone'];
  if ($phone && strlen($phone)>12){
    $db->prepare_exec('update user set phone=? where userid=?', array( basic::decode($phone), $user['userid'] ) );
  }
}

unset($db);

echo 'OK';