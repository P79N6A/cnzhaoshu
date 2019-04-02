<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/12/25
 * Time: 13:25
 */

include "../../wechat/send_message_pay.php";
include "../../com/db.php";
$db= new db();
$money=isset($_POST['money'])?$_POST['money']:"";
$user=isset($_POST['user'])?$_POST['user']:"";
if(!empty($user)){
    $user=json_decode($user,true);
    $user_id=$user['userid'];
    $user_wechat_id_sql="select wechatid,phone from user where userid=$user_id";
    $user_wechat=$db->query($user_wechat_id_sql)[0];
    $user_wechat_id=$user_wechat['wechatid'];
    $user_wechat_phone=$user_wechat['phone'];
//    $wang_wechat_id="oM-qJjrDS0xax5c0E86ZyoiUwlaU";
//    $wang_wechat_id="oM-qJjrDS0xax5c0E86ZyoiUwlaU";
    $wang_wechat_id="oM-qJjpvP_QfQb8ImuTa9YSnEfk4";
//    var_dump($wang_wechat_id);die;
}else{
    $content=[
        'msg'=>"当前用户信息为空"
        ,"status"=>"2"
    ];
    echo json_encode($content);die;
}
if($money=='1900'){

    send_message($user_wechat_id,"您已开通旗舰店","1900元","旗舰店开通","找树网提供");
    send_message($wang_wechat_id,$user_wechat_phone."已开通旗舰店","1900元","旗舰店开通","找树网提供");

}else{

    send_message($user_wechat_id,"您已开通认证店","1500元","认证店开通","找树网提供");
    send_message($wang_wechat_id,"$user_wechat_phone"."已开通认证店","1500元","认证店开通","找树网提供");

}
