<?php
// 删除未匹配名称
// $.getJSON('/com/dictionary_none_search.php', function(json){...});
require 'checkhost.php';
require 'db2.php';

$name = $_REQUEST['name'];	

$sql = 'update dictionary_none set state=1 where name=?';

$db = new db();
$db->prepare_exec( $sql, array( $name ) );
unset($db);

?>