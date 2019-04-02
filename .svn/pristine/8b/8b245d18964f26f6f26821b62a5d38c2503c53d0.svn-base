<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/11/21
 * Time: 11:01
 * 已合并店铺下//解除合并店铺接口 // 并且发送模板通知
 */

header('Access-Control-Allow-Origin:*');
include "../../com/db.php";

include "../define_attr/BaseController.php";

$db = new db();

$base = new BaseController();

//var_dump($_GET);die;
$shopid = isset($_POST['shopid']) ? $_POST['shopid'] : "";

$userid = isset($_POST['userid']) ? $_POST['userid'] : "";

if($shopid == $userid){

    echo $base->_res('6','主店铺不能移除','');die;

}
$shop_info_sql="select userid,shopname,wechatid from user where shopid='".$shopid."'";

$shop_info=$db->query($shop_info_sql);

$sql = "update user set shopid = '" . $userid . "' where userid = '" . $userid . "'";
//var_dump($sql);die;
$res = $db->exec($sql);
//var_dump($res);die;
if (!$res) {

    echo $base->_res('3', '移除失败', "");

} else {
    $user_info_sql="select userid,wechatid,shopname,`name` from user where userid = '".$userid."'";

    $user_info=$db->query($user_info_sql)[0];
//    var_dump($user_info);die;
    require "../../wechat/send_message_store_split.php";
  send_message($user_info['wechatid'],"您已被".《.$user_info['shopname'].》."移除",$user_info['shopname'],"你已经不是".$user_info['shopname']."的分店，苗木数据不再共享");
    require "../../wechat/send_message_other_store.php";
    $i="";
    for($i=0;$i<count($shop_info);$i++){
        if($user_info['wechatid']!=$shop_info[$i]['wechatid']){
            send_message_other($shop_info[$i]['wechatid'],"您合作店铺中".《.$user_info['name'].》."已被主店".《.$shop_info[$i]['shopname'].》."移除",$shop_info[$i]['shopname'],《.$shop_info[$i]['shopname'].》."店铺苗木数据不再与他共享");
        }
    }
        echo $base->_res('0', '移除成功', "");
}
