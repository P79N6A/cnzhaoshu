<?php

require 'db.php';
require '../PHPExcel/PHPExcel.php';

$db = new db();

$data = $db->query('select id,tree_name from lmzm_tree order by id asc limit 18000,5000');

if($data){
    for ($i=0; $i < count($data); $i++) {
        $arr = $data[$i];
        $name = trim($arr['tree_name'],' ');

        $sql = 'select name from tree_aliases where name=? or find_in_set(?,aliases_name)';
        $tree_aliases = $db->prepare_query($sql,array($name,$name));
        if($tree_aliases){
            $name = $tree_aliases[0]['name'];
        }

        $sql = 'update lmzm_tree set aliases_name=? where id=?';
        $result = $db->prepare_exec($sql,array($name,$arr['id']));
    }
}


