<?php
/* 
删除养护日志，同时删除照片
*/ 

// require '../checkhost.php'; // 来路域名验证
require '../db.php';
require 'record.php';

echo  record::delete($_POST['id'], $_POST['treeid']);


