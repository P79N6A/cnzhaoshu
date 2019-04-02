<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/11/26
 * Time: 12:03
 * 修改店铺等级
 */
header('Access-Control-Allow-Origin:*');
include "../define_attr/BaseController.php";

include "../../com/db.php";

$base = new BaseController();

$db = new  db();

$member_level = isset($_POST['member_level']) ? $_POST['member_level'] : "";
$member_paid_time=date("Y-m-d H:i:s",time());
$member_expire_time=date("Y-m-d H:i:s",time()+86400*365);
$first_authentication_time =time();
$shopid = isset($_POST['shopid']) ? $_POST['shopid'] : "";

if($member_level==1){
    $sql = "update user set member_level='" . $member_level . "',isrenzheng=1,first_authentication_time =(case when first_authentication_time is null then $first_authentication_time else first_authentication_time end) ,member_paid_time = '" . $member_paid_time . "',member_expire_time ='" . $member_expire_time . "'  where shopid='" . $shopid . "'";
}else if($member_level==2){
    $sql = "update user set member_level='" . $member_level . "',role=101,first_authentication_time =(case when first_authentication_time is null then $first_authentication_time else first_authentication_time end) ,member_paid_time = '" . $member_paid_time . "',member_expire_time ='" . $member_expire_time . "'  where shopid='" . $shopid . "'";

}else{
    $sql = "update user set member_level='" . $member_level . "',role=0,isrenzheng=0,first_authentication_time =(case when first_authentication_time is null then $first_authentication_time else first_authentication_time end) ,member_paid_time = '" . $member_paid_time . "',member_expire_time ='" . $member_expire_time . "'  where shopid='" . $shopid . "'";
}


//var_dump($sql);die;
$res = $db->exec($sql);

if (!$res) {

    echo $base->_res('1', '', '修改错误');

} else {

    echo $base->_res('0', '', '修改成功');

}