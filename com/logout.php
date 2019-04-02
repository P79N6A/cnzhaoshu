<?php
/*
 第三方开放平台 取消登录
 */
header('P3P: CP=CAO PSA OUR');

setcookie('user2', '', time() - 1000, '/', 'cnzhaoshu.com');

?>