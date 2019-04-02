<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-27 14:13:00
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-24 17:05:57
 * 苗木下的每科树状态的列表
 */
require "../../com/db.php";
require "../define_attr/Define_tree_state.php";
require "./public_function.php";
Access_Header(); // header头信息

$db = new db();
// 获取userID和角色id
$user=json_decode($_COOKIE['user2'],true);
$userid=isset($user['userid'])?$user['userid']:"";
$user_role=isset($user['role'])?$user['role']:"";
// 接值
$data = $_POST;

$tender_order_id = isset($data['tender_order_id'])?$data['tender_order_id']:"";
// 异常状态
$state = isset($data['state'])?$data['state']:"";
// 页数
$page = isset($data['page'])?$data['page']:"1";

unset($data);
// 查询合同编号，订单名称
$sql = "select
a.id as map_id,a.order_id,a.project_id,a.name,b.order_num
from
maps a
left join contract b on a.order_id=b.tender_order_id
where tender_order_id = $tender_order_id ";

$result = $db->query($sql)[0];

unset($sql);
// 查找当前供应商在当前项目下所有订单id
$order_sql = "select tender_order_id from tender_order where
    tender_user_id = ( select tender_user_id from tender_order where tender_order_id = '".$result['order_id']."' ) and project = '".$result['project_id']."' and provider_status =1";

$order = $db->query($order_sql);

foreach ($order as $key => $val) {

    $order_id[] = $val['tender_order_id'];

}

$order_id = implode(',',$order_id);
// 查询一共绑定了多少二维码
$sql = "select count( qrcode ) as sum from maps a left join maps_order b on a.id = b.map_id where a.project_id = '".$result['project_id']."' and a.order_id in ($order_id) and b.binding_status = 2";

$result['sum'] = $db->query($sql)[0]['sum'];

unset($sql);

$where = '';
// 异常苗木列表
if($state == '7'){
    $where .= ' a.state = 5 and (b.state = 1 or b.state =2) and ';
}
// 设置每页显示的条数
$page_num = 10;
// 统计一共有多少条
$sql = "select count( qrcode ) as sum from maps c left join maps_order a on c.id = a.map_id left join maps_unusual b on a.id = b.maps_order_id where $where c.project_id = '".$result['project_id']."' and c.order_id in ( $order_id) and a.binding_status = 2";

$total = $db->query($sql)[0]['sum'];

// 计算一共多少页
$total_page=ceil($total/$page_num)!=0?ceil($total/$page_num):1;
// 计算从哪条开始
$start=($page-1)*$page_num>0?($page-1)*$page_num:0;

unset($sql);
// 查找每隔二维码的具体信息
$sql = "select
a.id as maps_order_id,a.qrcode,a.state as order_state,a.tree_name,a.dbh,a.crown,a.plant_height,a.company,a.binding_status,b.state as unusual_state
from
maps c
left join maps_order a on c.id = a.map_id
left join maps_unusual b on a.id = b.maps_order_id
where $where a.binding_status = 2 and c.project_id = '".$result['project_id']."' and c.order_id in ($order_id) limit $start,$page_num";

$result['content'] = $db->query($sql);
// 判断如果没有二维码信息
if(!$result['content']){

    $result['content'] = [];

}else{

    $tree_atate = new Define_tree_state();
     // 循环判断状态值并赋值文字
    foreach ($result['content'] as $key => $val) {

        if($val['order_state'] == '0' && $val['binding_status'] == '1'){
        // 首次绑定
            $result['content'][$key]['order_state'] = $tree_atate->tree_state[6];

        }elseif($val['order_state'] == '5'){
        // 验收
            $result['content'][$key]['order_state'] = $tree_atate->tree_state[5];

        }else{
        // 其他状态
            $result['content'][$key]['order_state'] = $tree_atate->tree_state[$val['order_state']-1];
        }

    }

    unset($tree_atate);

}

unset($db);

$content=[

    // 'status'=>0,                 //状态值

    'total'=>$total,      //查询到的数据

    'page' =>$page>$total_page?$total_page:$page,              //当前页

    'total_page' =>$total_page,  //总页数

    'data'=>$result                //数据

];

_res(0,'请求成功',$content);


