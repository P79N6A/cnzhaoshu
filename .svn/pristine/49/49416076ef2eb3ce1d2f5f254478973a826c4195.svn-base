<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/11/16
 * Time: 9:36
 * 店铺展示页面
 */
header('Access-Control-Allow-Origin:*');
//引入返回值页面
include "../define_attr/BaseController.php";
//引入数据库
include "../../com/db.php";
//var_dump($_POST);die;
$base = new BaseController();

$db = new  db();
//店铺名称
$member_paid_time=isset($_POST['member_paid_time'])?$_POST['member_paid_time']:"";
$member_expire_time=isset($_POST['member_expire_time'])?$_POST['member_expire_time']:"";
$shop_name = isset($_POST['shop_name']) ? $_POST['shop_name'] : "";
//店铺等级
$member_level = isset($_POST['member_level']) ? $_POST['member_level'] : "";
//当前页的传输
$p = isset($_POST['page']) ? $_POST['page'] : "1";
//页面展示条数
$page_num = isset($_POST['limit'])?$_POST['limit']:"";
//开始位置
$start = ($p - 1) * $page_num;
//定义 where条件
$where = "1";
//判断当前是否传入店铺名称并入where条件里
if ($shop_name == "") {

    $where .= "";

} else {

    $where .= " and shopname like '%" . $shop_name . "%' ";

}
//判断当前是否传入店铺等级并入where 条件里
if ($member_level == "") {

    $where .= "";

} else {

    $where .= " and member_level = '" . $member_level . "'";

}
//var_dump($where);die;
//判断当前是否传入认证时间和到期时间
if ($member_paid_time != "" && $member_expire_time != "") {
    $member_paid_time=strtotime($member_paid_time);
    $member_expire_time=strtotime($member_expire_time);
    $where .= " and unix_timestamp(member_paid_time) >=  $member_paid_time  and unix_timestamp(member_expire_time) <= $member_expire_time ";

} elseif ($member_paid_time != "" && $member_expire_time == "") {
    $member_paid_time=strtotime($member_paid_time);
    $where .= " and unix_timestamp(member_paid_time) >= $member_paid_time";

} elseif ($member_paid_time == "" && $member_expire_time != "") {
    $member_expire_time=strtotime($member_expire_time);
    $where .= " and unix_timestamp(member_expire_time) <= $member_expire_time ";

} else {
    $where .= "";
}
//查询总页数
$totle_num_sql = "select count(*) as totle from user where $where and shopname IS NOT NULL and shopname <> '' and userid = shopid ";
//var_dump($totle_num_sql);die;
$totle = $db->query($totle_num_sql)[0]['totle'];
//根据传入条件拼接SQL
$sql = "select shopid,shopname,member_level,`time`,member_paid_time,member_expire_time,phone 
from user where $where and shopname IS NOT NULL and shopname<>'' and  userid = shopid order by userid limit $start,$page_num";
//执行SQL语句
//var_dump($sql);die;
$data = $db->query($sql);
//var_dump($data);die;
echo $base->_res("0", $totle, $data);
