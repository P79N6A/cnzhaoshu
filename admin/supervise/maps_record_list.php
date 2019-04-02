<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-27 17:12:32
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-24 16:17:40
 * 监管详情接口
 */
require "../../com/db.php";
require "./public_function.php";
Access_Header(); // header头信息
$map_order_id = $_POST['id'];
// 获取userID
$user=json_decode($_COOKIE['user2'],true);

$userid=isset($user['userid'])?$user['userid']:"";
// 获取当前用户的角色
$role['role'] = isset($user['role'])?$user['role']:"0";
$db = new db();
//  查找二维码绑定的树木
$sql = 'select tree_name,tree_attribute,dbh,crown,plant_height,qrcode,ground_diameter,high_branch_point from maps_order where id=?';

$data = $db->prepare_query($sql,array($map_order_id));
// 查找二维码绑定了多少棵树
$sql = "select count(id) as sum from maps_order where qrcode = ?";

$newdata['info']['sum'] = $db->prepare_query($sql,array($data[0]['qrcode']))[0]['sum'];
// 数据处理
foreach ($data as $key => $val) {
    $newdata['info']['map_order_id'] = $map_order_id;
    $newdata['info']['tree_name'] = $val['tree_name'];
    $newdata['info']['tree_attribute'] = $val['tree_attribute'];
    $newdata['info']['ground_diameter'] = $val['ground_diameter'];
    $newdata['info']['dbh'] = $val['dbh'];
    $newdata['info']['crown'] = $val['crown'];
    $newdata['info']['plant_height'] = $val['plant_height'];
    $newdata['info']['high_branch_point'] = $val['high_branch_point'];
    $newdata['info']['qrcode'] = $val['qrcode'];
}
// 查询已经上传的监管信息
$sql = 'select
a.id,a.map_id,a.map_order_id,a.active,a.type,a.photo,a.name,a.phone,a.time,a.driver_name,a.driver_phone,a.plate_number,a.remark,b.state as unusual_state,b.userid,b.content
from
maps_record a
left join maps_unusual b on a.map_order_id = b.maps_order_id
where map_order_id=? order by type asc';

$result = $db->prepare_query($sql,array($map_order_id));
// 数据处理
foreach ($result as $key => $val) {
    // 判断是否有图片
    if($val['photo']){

        $result[$key]['photo'] = explode(',',$val['photo']);

    }else{

        $result[$key]['photo'] = [];

    }
    // 判断是否有管理员处理信息
    if($val['content']){

        $result[$key]['content'] = $val['content'];

    }else{

        $result[$key]['content'] = "";

    }
    // 不是发车
    if($val['type'] != '3'){
       unset($result[$key]['driver_name']);
       unset($result[$key]['driver_phone']);
       unset($result[$key]['plate_number']);
    }
    // 判断验收完是否异常
    if($val['type'] != "5" || ($val['type'] == "5" && $val['unusual_state'] == '')){
        unset($result[$key]['content']);
        unset($result[$key]['unusual_state']);
        unset($result[$key]['userid']);
    }
    $role['unusual_state'] = $val['unusual_state'];

}

//判断是否为管理员并且是否没有审核过异常信息
if(($role['role'] == '8' ||$role['role'] == '9' || $role['role'] == '6' ) && $role['unusual_state'] == '2'){

    $newdata['is_show'] = '1';

}else{

    $newdata['is_show'] = '0';

}

$newdata['record'] = $result;

$newdata = _unsetNull($newdata);

unset($db);

echo json_encode($newdata);


