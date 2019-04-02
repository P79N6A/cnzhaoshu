<?php
// 查询属性字典
// if ( empty($_SERVER['HTTP_REFERER']) || strtolower($_SERVER['SERVER_NAME'])!='cnzhaoshu.com') exit; 

require 'db.php';
require 'pinyin.php';

$db = new db();
$result = $db->query('select name from dictionary_attribute');

foreach ($result as $row) {
	$sql = 'update dictionary_attribute set jianpin=? where name=?';
	$db->prepare_exec( $sql, array( getPinyin($row['name']), $row['name'] ) );
}

unset($db);

echo 'finish!';
?>