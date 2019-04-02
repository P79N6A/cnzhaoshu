<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-26 18:12:35
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-24 17:15:50
 * 全部项目下苗木列表接口
 */

require "../../com/db.php";
require "./public_function.php";
Access_Header(); // header头信息
$db = new db();

$data = $_POST;
// 项目id
$project_id=isset($data['project_id'])?$data['project_id']:"";
// 获取userID和角色id
$user=json_decode($_COOKIE['user2'],true);
$userid=isset($user['userid'])?$user['userid']:"";
$user_role=isset($user['role'])?$user['role']:"";

unset($data);

$where = '';
// 判断是否为甲乙方
if($user_role == '0'){
 // 检查当前用户是否有企业信息
    $sql = "select company_name from contract_info where userid=".$userid;

    $company_name=$db->query($sql)[0]['company_name'];

    unset($sql);
    // 有的话就查询自己公司 甲方
    if($company_name){

        $company .= ' ( b.partya_company_name ="'.$company_name.'" or ';
        $end = ")";
    }else{
        $company_name .= ' ';
        $end = "";
    }
    //乙方
    $where .= '  '.$company.' a.tender_user_id ="'.$userid.'" and a.tender_status = 2
    and a.adoption_status = 1 '.$end.' and ';

}
// 查询数据
$sql = "select
a.tender_order_id,a.tender_user_id,b.partya_company_name,c.order_num,c.project_id
from
tender_order a
left join order_project b on a.project=b.project_id
left join contract c on a.tender_order_id=c.tender_order_id
where $where
    a.project = $project_id and a.provider_status = 1
group by a.tender_user_id";

$result = $db->query($sql);

unset($sql);
// 数据处理
if($result){
    foreach ($result as $key => $val) {
        // 查询乙方名称
        $sql = "select b.name FROM user b where b.userid = '".$val['tender_user_id']."'";

        $result[$key]['partyb_company_name'] = $db->query($sql)[0]['name'];
        // 查询绑定二维码数量
        $sql = "select count( qrcode ) as sum from
        maps a left join maps_order b ON a.id = b.map_id
        where a.project_id = '".$val['project_id']."' and a.order_id in (select tender_order_id from tender_order where tender_user_id = '".$val['tender_user_id']."' and project = '".$val['project_id']."') and b.binding_status = 2";

        $sum = $db->query($sql)[0]['sum'];

        unset($sql);

        if($sum){

            $result[$key]['sum'] = $sum;

        }else{

            $result[$key]['sum'] = '0';

        }

    }

    $result = _unsetNull($result);

}else{

    $result= [];

}

unset($db);

$content=[

    'data'=>$result                //数据

];

_res(0,'200',$content);





