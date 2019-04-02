<?php
// 插入或更新属性字典
// var data = {"type":1,"typename":"落叶乔木","name":"","ldname","","unit":"株","attribute":"6,8,13"};
// $.post('/com/dictionary_attribute_update.php',{data:JSON.stringify(data)},function(){...});
require 'checkhost.php'; checkhost();
require 'db2.php';
require 'dictionary.attribute.class.php';

if (isset($_REQUEST['data'])) {
	$data = json_decode($_REQUEST['data'], true);

	attribute::update($data);
}

?>