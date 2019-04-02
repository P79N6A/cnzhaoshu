<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/8/29
 * Time: 15:15
 * 苗圃地址接口
 */
include "../com/db.php";

$user=json_decode($_COOKIE['user2'],true);

$userid=$user['userid'];

$tree_name=isset($_POST['tree_name'])?$_POST['tree_name']:"";

$db=new db();

$sql="select province,city,district  from tree where userid='".$userid."' and name ='".$tree_name."'";

$res=$db->query($sql)[0];

$content=[

    'status'=>0,
	
    'data'=>$res
	
];

echo json_encode($content);
