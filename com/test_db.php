<?php
// 测试数据库连接

require 'db.php';

$db = new db();
echo $db->exec("insert into test set name=sensen");
// echo $db->prepare_exec('insert into test set name2=?',array('sensen'));
// echo $db->insert("insert into test set name='sensen'");
$result = $db->query('select * from test');
unset($db);


if ($result) {
	echo json_encode($result);
}else{
	echo 'db error';
}

?>