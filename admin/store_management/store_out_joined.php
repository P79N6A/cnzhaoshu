<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/11/21
 * Time: 15:42
 * 待合并店铺//合并店铺接口 // 并进行模板推送
 */
header('Access-Control-Allow-Origin:*');
include "../../com/db.php";

include "../define_attr/BaseController.php";

$db = new db();

$base = new BaseController();

$shopid = isset($_POST['shopid']) ?$_POST['shopid'] : "";

$userid = isset($_POST['userid']) ?$_POST['userid'] : "";

//var_dump($_POST);die;
$shop_name_info_sql="select shopname,wechatid, userid from user where shopid='".$shopid."'";


$shop_name_info=$db->query($shop_name_info_sql);

//var_dump($shop_name_info);die;
$shopinfo_sql = "select shopname,member_level from user where userid ='" . $shopid . "'";


$shopinfo = $db->query($shopinfo_sql)[0];

$userinfo_sql="select userid,wechatid,`name`,shopname from user where userid ='".$userid."'";

$userinfo=$db->query($userinfo_sql)[0];

$sql = " update user set shopid='" . $shopid . "',shopname='" . $shopinfo['shopname'] . "' ,member_level='" . $shopinfo['member_level'] . "' where userid= $userid";

$res = $db->exec($sql);

if (!$res) {

    echo $base->_res('1', '加入失败', "");

} else {

    require "../../wechat/send_message_store_merger.php";
    send_message($userinfo['wechatid'],"您已成功加入".《.$shopinfo['shopname'].》."店铺",$shopinfo['shopname'],"你已经成为".《.$shopinfo['shopname'].》."的分店，可以共享".《.$shopinfo['shopname'].》."的苗木数据");
    require "../../wechat/send_message_other_store.php";
    $i="";
    for($i=0;$i<count($shop_name_info);$i++){
        send_message_other($shop_name_info[$i]['wechatid'],"您合作店铺中".《.$userinfo['name'].》."已加入主店".《.$shop_name_info[$i]['shopname'].》,$shop_name_info[$i]['shopname'],《.$shop_name_info[$i]['shopname'].》."店铺苗木数据与他共享，并添加了他的苗圃数据哦");
    }
    echo $base->_res('0', '合并成功', "");

}