<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-22 14:11:19
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-25 13:55:41
 * userID和phone手机号绑定
 */
require "../../com/db.php";
require "./public_function.php";
include "./Loginterface.php";
Access_Header(); // header头信息
// 获取userID
$user   =json_decode($_COOKIE['user2'],true);
$userid =isset($user['userid'])?$user['userid']:"";
//开启日志
Loginterface::start( 'binding-phone' );

$data = $_POST;

$phone  = isset($data['phone'])?$data['phone']:"";
$type   = isset($data['type'])?$data['type']:"1";
//写入日志
$requestData = '绑定时间：'.date('Y-m-d H:i:s').'  绑定信息：'.json_encode($data);

Loginterface::add( $requestData);

unset($data);
// 验证手机格式
$checkphone = isPhone($phone);

if($user_phone){
    //写入日志
    $requestData = '绑定时间：'.date('Y-m-d H:i:s').'  错误信息：'.json_encode(array('status' => 1,'msg'=>'手机号格式不正确'));

    Loginterface::add( $requestData);
    _res(1,'手机号格式不正确');

}
// 验证手机号唯一性
$checkUnique = checkUnique('user','phone',$phone);

if($user_phone){
    //写入日志
    $requestData = '绑定时间：'.date('Y-m-d H:i:s').'  错误信息：'.json_encode(array('status' => 1,'msg'=>'该手机号已经存在'));

    Loginterface::add( $requestData);
    _res(1,'该手机号已经存在');

}

$db = new db();
if($type ==1){

    $sql = "select phone from user where userid = '".$userid."'";

    $user_phone = $db->query($sql)[0]['phone'];
    unset($db);
    if(!empty($user_phone)){
        //写入日志
        $requestData = '绑定时间：'.date('Y-m-d H:i:s').'  错误信息：'.json_encode(array('status' => 1,'msg'=>'该用户已经绑定手机号'));

        Loginterface::add( $requestData);
        _res(1,'该用户已经绑定手机号');

    }else{

        binding_phone($userid,$phone);

    }

}elseif ($type ==2) {

    binding_phone($userid,$phone);

}

/**
 * 绑定手机号
 * @param  [type] $userid  用户id
 * @param  [type] $phone 手机号
 * @return [type]        [description]
 */
function binding_phone($userid,$phone){
    $db = new db();

    $sql = "update user set phone = '".$phone."' where userid = '".$userid."'";

    if($db->exec($sql)){

        $sql = "update contract_info set userid = '".$userid."' where tel = '".$phone."' ";

        $db->exec($sql);
        //写入日志
        $requestData = '绑定时间：'.date('Y-m-d H:i:s').'  成功信息：'.json_encode(array('status' => 0,'msg'=>'绑定成功'));

        Loginterface::add( $requestData);
        Loginterface::end();
        $content['status'] = 0;

        $content['msg'] = '绑定成功';

    }else{
        //写入日志
        $requestData = '绑定时间：'.date('Y-m-d H:i:s').'  错误信息：'.json_encode(array('status' => 1,'msg'=>'绑定失败，请联系管理员'));

        Loginterface::add( $requestData);
        Loginterface::end();
        $content['status'] = 1;

        $content['msg'] = '绑定失败，请联系管理员';

    }

    unset($db);

    _res($content['status'],$content['msg']);
}
