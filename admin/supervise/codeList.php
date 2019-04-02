<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-22 14:56:57
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-24 16:37:45
 * 绑定二维码时二维码列表接口
 */
require "../../com/db.php";
require "./public_function.php";
Access_Header(); // header头信息
$db = new db();
$tender_order_id = isset($_POST['tender_order_id'])?$_POST['tender_order_id']:"";
// 查找当前供应商一共所绑定的树牌
$sql="select
sum(tree_num) as tree_sum
from tender_order a
where
tender_user_id = (select tender_user_id from tender_order where tender_order_id = '".$tender_order_id."' ) and project = (select project from tender_order where tender_order_id = '".$tender_order_id."' )";
$qrcode_sum=$db->query($sql)[0]['tree_sum'];
// 根据项目id查找当前供应商所绑定的树牌
$sql = "select
c.id,c.qrcode
from
    tender_order a
    left join maps b on a.tender_order_id=b.order_id
    left join maps_order c on b.id = c.map_id
where tender_user_id = (select tender_user_id from tender_order where tender_order_id = '".$tender_order_id."' )and project = (select project from tender_order where tender_order_id = '".$tender_order_id."' ) and qrcode is not null";

$res=$db->query($sql);

$res = _unsetNull($res);

unset($db);

if($res){

    $content=[

        'count'=>$qrcode_sum,

        'data'=>$res,

    ];

}else{

    $content=[

        'count'=>$qrcode_sum,

        'data'=>[]
    ];
}

_res(0,'请求成功',$content);
