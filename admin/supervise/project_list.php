<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-26 14:57:36
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-24 16:17:13
 * 全部项目列表接口
 */
require "../../com/db.php";
require "./public_function.php";
Access_Header(); // header头信息
$db = new db();

$data = $_POST;
// 获取userID和角色id
$user=json_decode($_COOKIE['user2'],true);
$userid=isset($user['userid'])?$user['userid']:"";
$user_role  =isset($user['role'])?$user['role']:"";
//前台请求的页码
$page=isset($data['page'])?$data['page']:1;
//是否完成项目  1未完成   2已完成
$status=isset($data['status'])?$data['status']:1;
//名称 搜索
$project_name=isset($data['project_name'])?$data['project_name']:"";

unset($data);
// 设置每页显示的条数
$page_num = 10;
// 项目是否完成
$where = "a.state= $status  and (a.status between 2 and 4)";

$sql = '';
// 判断是否为甲乙方
if($user_role == '0'){
 // 检查当前用户是否有企业信息
    $sql = "select company_name from contract_info where userid=".$userid;

    $company_name=$db->query($sql)[0]['company_name'];

    unset($sql);
    // 有的话就查询自己公司 甲方
    if($company_name){

        $company .= ' ( a.partya_company_name ="'.$company_name.'" or ';
        $end = ")";
    }else{
        $company_name .= ' ';
        $end = "";
    }
    // 乙方
    $where .= ' and '.$company.' b.tender_user_id ="'.$userid.'" and b.tender_status = 2 and b.adoption_status = 1 '.$end.' ';

    $sql_string .=' left join tender_order b on a.project_id = b.project ';

}
//搜索项目名称
if(!empty($project_name)){

    $where .="and a.project_name like '%".$project_name."%'";

}
// 统计一共有多少条数据
$sql = "select count(project_id) as num from order_project a $sql_string where $where order by project_time desc";

$total=$db->query($sql)[0];

unset($sql);
// 计算一共多少页
$total_page=ceil($total['num']/$page_num);
// 计算从哪条开始
$start=($page-1)*$page_num>0?($page-1)*$page_num:0;
// 查询数据
$sql = "select
a.project_id,a.project_name,a.project_time,concat(a.hcity,a.hproper,a.harea) as address
from order_project a $sql_string where $where order by project_time desc limit $start,$page_num";

$data=$db->query($sql);
//判断是否查询到数据
if($data){
    foreach ($data as $key => $val) {
         // 循环查询每条数据绑定树牌的数量
        $sql = "select count(b.qrcode) as sum from maps a left join maps_order b on a.id=b.map_id where a.project_id ='".$val['project_id']."' and b.binding_status = 2";

        $data[$key]['sum']=$db->query($sql)[0]['sum'];

        unset($sql);
    }

    $data = _unsetNull($data);

}else{

    $data= [];

}

$content=[

    'status'=>0,                 //状态值

    'total'=>$total['num'],      //查询到的数据

    'page' =>$page,              //当前页

    'total_page' =>$total_page,  //总页数

    'data'=>$data                //数据

];

echo  json_encode($content);


