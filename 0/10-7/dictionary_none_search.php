<?php
// 获取所有未匹配名称
// $.getJSON('/com/dictionary_none_search.php', function(json){...});
require 'checkhost.php';
require 'db2.php';

$sql = 'select name from dictionary_none where state=0 order by CONVERT(name USING gbk)';

$db = new db();
$result = $db->query($sql);
unset($db);

echo json_encode($result);

?>