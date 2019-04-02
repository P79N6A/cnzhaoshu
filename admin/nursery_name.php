<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/8/29
 * Time: 15:15
 * 根据userID查询苗圃苗木
 */
if($_SERVER['HTTP_HOST']=="test.cnzhaoshu.com"){
    header('Access-Control-Allow-Origin:*');
}
include "../com/db.php";
//需要修改的地方
$user=json_decode($_COOKIE['user2'],true);

$user=$user['userid'];

$userid=isset($user)?$user:"";

$db=new db();

$sql="select name,dbh,crownwidth,height from tree where userid='".$userid."'";

$res=$db->query($sql);

$user_sql="select phone from user where userid='".$userid."'";
$phone=$db->query($user_sql)[0]['phone'];
if($phone == ""){
    $isnull_user=0;
}else{
    $isnull_user=1;
}
$content=[

    'status'=>0,
	
    'data'=>$res,

    'isnull_user'=>$isnull_user
	
];

echo json_encode($content);
