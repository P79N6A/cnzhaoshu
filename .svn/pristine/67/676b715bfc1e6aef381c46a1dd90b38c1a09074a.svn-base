<?php

require 'db.php';

$db = new db();

$data = $db->query('select gname,type,isplant from lmzm_dictionary');

$result = $db->query('select id,aliases_name from lmzm_tree');

$m = count($data);
$n = count($result);
for ($i=0; $i < $n; $i++) { 
	$name = $result[$i]['aliases_name'];

	for ($j=0; $j < $m; $j++) { 
		if($name == $data[$j]['gname']){
			$sql = 'update lmzm_tree set type=?,isplant=? where id=?';
			$db->prepare_exec($sql,array($data[$j]['type'],$data[$j]['isplant'],$result[$i]['id']));
		}
	}
}