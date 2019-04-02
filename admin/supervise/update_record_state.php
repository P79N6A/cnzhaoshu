<?php
/**
 * @Author: anchen
 * @Date:   2018-12-05 10:24:20
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-25 13:55:16
 * 管理员对异常苗木的审核
 */
require "../../com/db.php";
require "./public_function.php";
include "./Loginterface.php";
Access_Header(); // header头信息

$data = $_POST;
// 获取maps_order_id
$id = isset($data['id'])?$data['id']:"";
// 获取userID和角色id
$user=json_decode($_COOKIE['user2'],true);

$userid=isset($user['userid'])?$user['userid']:"";
// 获取管理员备注
$content = isset($data['content'])?$data['content']:"";
//生成日志文件
Loginterface::start( 'record-state' );

$requestData = '写入时间：'.date('Y-m-d H:i:s').'  处理信息：'.json_encode($data);

Loginterface::add( $requestData);

unset($data);

$db= new db();
// 创建审核时间
$update_time = date('Y-m-d H:i:s', time());

$checkstate = checkstate($userid,$id);

if($checkstate){

    $sql = "update maps_unusual set state = '1' ,userid='".$userid."',content='".$content."',update_time='".$update_time."'where maps_order_id='".$id."'";

    $res = $db->exec($sql);

    unset($sql);
    unset($db);

    if($res){
        //生成日志文件
        $requestData = '写入时间：'.date('Y-m-d H:i:s').':'.json_encode(array('status' => 0,'msg'=>'审核成功'));
        Loginterface::add( $requestData);
        Loginterface::end();
        _res(0,'审核成功');

    }else{
        //生成日志文件
        $requestData = '写入时间：'.date('Y-m-d H:i:s').':'.json_encode(array('status' => 1,'msg'=>'审核失败或者已经有其他管理员提交审核'));
        Loginterface::add( $requestData);
        Loginterface::end();
        _res(1,'审核失败或者已经有其他管理员提交审核');

    }

}else{
    //生成日志文件
    $requestData = '写入时间：'.date('Y-m-d H:i:s').':'.json_encode(array('status' => 1,'msg'=>'平台错误，请联系管理员'));
    Loginterface::add( $requestData);
    Loginterface::end();
    _res(1,'平台错误，请联系管理员');

}



