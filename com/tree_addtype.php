<?php

require 'db.php';
require '../PHPExcel/PHPExcel.php';

$db = new db();

$data = $db->query('select id,tree_name,aliases_name from lmzm_tree order by id asc limit 18000,5000');

$dictionary = $db->query('select * from dictionary_attribute order by CONVERT(name USING gbk)');
$n = count($dictionary);

if($data){
    for ($i=0; $i < count($data); $i++) {
        $arr = $data[$i];
        $name = trim($arr['tree_name'],' ');

        $nothas = true;
        for ($j=0; $j < $n; $j++) {
            if($dictionary[$j]['name'] == $name){
                $sql = 'update lmzm_tree set type=? where id=?';
                $result = $db->prepare_exec($sql,array($dictionary[$j]['type'],$arr['id']));
                $nothas = false;
            }
        }

        if($nothas){
            $name = trim($arr['aliases_name'],' ');
            for ($j=0; $j < $n; $j++) {
                if($dictionary[$j]['name'] == $name){
                    $sql = 'update lmzm_tree set type=? where id=?';
                    $result = $db->prepare_exec($sql,array($dictionary[$j]['type'],$arr['id']));
                    $nothas = false;
                }
            }
        }

    }
}


