<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-30 10:05:22
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-25 13:51:28
 * 上传监管数据接口
 */

require "../../com/db.php";
require "../define_attr/Define_tree_state.php";
require "./public_function.php";
include "./Loginterface.php";
Access_Header(); // header头信息
// ini_set("display_errors", "On");
$data = $_POST;
// 苗木绑定的id
$maps_order_id = isset($data['id'])?$data['id']:"";
// 苗木监管状态
$state = isset($data['state'])?$data['state']:"";
// 负责人名称
$name = isset($data['name'])?$data['name']:"";
// 负责人联系方式
$phone = isset($data['phone'])?$data['phone']:"";
// 司机名称
$driver_name = isset($data['driver_name'])?$data['driver_name']:"";
// 司机联系方式
$driver_phone = isset($data['driver_phone'])?$data['driver_phone']:"";
// 司机车牌号
$plate_number = isset($data['plate_number'])?$data['plate_number']:"";
// 备注信息
$remark = isset($data['remark'])?$data['remark']:"";
// photo
$photo = isset($data['photo'])?implode(',',$data['photo']):"";
// GPS
$gps = isset($data['gps'])?$data['gps']:"";

$type = isset($data['type'])?$data['type']:"0";

$Loginterface = new Loginterface();

Loginterface::start( 'record' );
//生成日志文件
$requestData = date('Y-m-d H:i:s').':  '.json_encode($data);

Loginterface::add( $requestData);
// 设置推送角色
$send_role = [8];
// 判断如果是异常的苗木
if($type == 1)$state = 5;
// 获取用户信息
$user=json_decode($_COOKIE['user2'],true);
$userid=isset($user['userid'])?$user['userid']:"";

unset($data);

$db = new db();

// 检查是否已经上传过
$sql = 'select a.*,b.state,b.map_id from (select * from maps_record where map_order_id=? and type = ?) a right join (select state,id,map_id from maps_order where id=?) b on a.map_order_id = b.id';

$recordsinfo = $db->prepare_query($sql,array($maps_order_id,$state,$maps_order_id))[0];

$phototime = date('Y-m-d H:i:s', time());

$tree_atate = new Define_tree_state();
// 设置文字状态
$active = $tree_atate->tree_state[$state];

unset($tree_atate);

$str = '';
// 判断是否上传过监管信息
if($recordsinfo['id']){

    $content['status'] = 1;

    $content['msg'] = '已经上传过该步骤监管信息';

    //生成日志文件
    $requestData = '写入时间：'.date('Y-m-d H:i:s').'  错误信息：'.json_encode($content);
    Loginterface::add( $requestData);
    Loginterface::end();

    _res(1,$content['msg']);

}else{
    // 如果有车辆信息
    if($driver_name && $plate_number && $driver_phone){
        $str = "driver_name,driver_phone,plate_number,";
        $strtr = "'".$driver_name."','".$driver_phone."','".$plate_number."',";
    }else{
        $str = '';
        $strtr = '';
    }

    $db->query_try('BEGIN'); //开始事务

    $sql = "select count(*) as total from maps_record where map_id = '".$recordsinfo['map_id']."'and map_order_id= '".$maps_order_id."'and type='".$state."' FOR UPDATE";
    $row = $db->query($sql)[0]['total'];

    if($row >0){

        $content['status'] = 1;

        $content['msg'] = '已经上传过苗木异常信息';

        //生成日志文件
        $requestData = '写入时间：'.date('Y-m-d H:i:s').'  错误信息：'.json_encode($content);
        Loginterface::add( $requestData);
        Loginterface::end();

        _res(1,$content['msg']);
    }

    $sql = "insert into maps_record(userid,map_id,map_order_id,active,type,photo,gps,name,phone,time,".$str."remark) values('".$userid."','".$recordsinfo['map_id']."','".$maps_order_id."','".$active."','".$state."','".$photo."','".$gps."','".$name."','".$phone."','".$phototime."',".$strtr."'".$remark."')";

    $recordid = $db->query($sql);

    $db->query_try('COMMIT'); //提交事务
}

//如果是异常苗木
if($type == 1){

    $sql = "select unusual_id from maps_unusual where maps_order_id = '".$maps_order_id."' ";
    $unusual_id = $db->query($sql)[0]['unusual_id'];
    // 判断如果已经提交了异常
    if(!$unusual_id){
        // 添加到苗木异常表
        $sql = "insert into maps_unusual(maps_id,maps_order_id,photo,gps,name,phone,create_time,remark) values('".$recordsinfo['map_id']."','".$maps_order_id."','".$photo."','".$gps."','".$name."','".$phone."','".$phototime."','".$remark."')";

        $unusual_id = $db->insert($sql);

        unset($sql);
        // 给管理员发送异常通知
        $sql = "select b.project_name from maps a left join order_project b on a.project_id = b.project_id where id = '".$recordsinfo['map_id']."'";

        $project_name = $db->query($sql)[0]['project_name'];

        $send_role = implode(',',$send_role);
        // 查找管理员的wechatid
        $sql = "select userid,wechatid,name from user where role in ($send_role) ";

        $role = $db->query($sql);
        // 生成时间
        $send_time = date("Y-m-d",time());
        // 计算数组长度
        $count = count($role);
        // 循环推送模板
        //生成日志文件
        $requestData = '异常苗木提交时间：'.date('Y-m-d H:i:s').'  推送的管理员：'.json_encode($role);

        Loginterface::add( $requestData);

        for ($i=0; $i < $count; $i++) {
            send_message_unusual($role[$i]['wechatid'],'您有新苗木异常申报待审核','合同异常','验收通知','甲方验收苗木异常',$send_time,$project_name,"请管理员尽快核实",'http://'.$_SERVER['HTTP_HOST'].'/admin/mobile/zhaoshu/index.html#/treeUnusual/'.$maps_order_id);
        }

    }else{

        $content['status'] = 1;

        $content['msg'] = '已经上传过苗木异常信息';
        //生成日志文件
        $requestData = '写入时间：'.date('Y-m-d H:i:s').'  错误信息：'.json_encode($content);

        Loginterface::add( $requestData);
        Loginterface::end();
        _res(1,$content['msg']);
    }

}
// 更新状态
$sql = "update maps_order set state = if((state+1)>5,5,(state+1)),time='".$phototime."' where id='".$maps_order_id."'";

$state = $db->exec($sql);

unset($db);

$content['recordid'] = $recordid;

$content['state'] = $state;
//如果是异常苗木
if($type == 1){

    $content['unusual_id'] = $unusual_id;

}
//生成日志文件
$requestData = '写入时间：'.date('Y-m-d H:i:s').'  成功信息：'.json_encode($content);

Loginterface::add( $requestData);

Loginterface::end();

$data['data']=$content;

_res(0,'200',$data);



