<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/11/16
 * Time: 16:07
 * 合并店铺页面
 */

header('Access-Control-Allow-Origin:*');
//引入返回值页面
include "../define_attr/BaseController.php";
//引入数据库
include "../../com/db.php";

$base = new BaseController();
$db = new db();
//店铺名称
$shop_name = isset($_POST['shop_name']) ? $_POST['shop_name'] : "";
$shop_phone = isset($_POST['shop_phone']) ? $_POST['shop_phone'] : "";
//当前页的传输
$p = isset($_POST['page']) ? $_POST['page'] : "1";

//页面展示条数
$page_num = isset($_POST['limit'])?$_POST['limit'] :"";
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
if ($shop_phone == "") {

    $where .= "";

} else {

    $where .= " and phone = '" . $shop_phone . "'";

}

//根据传入条件拼接SQL
$totle_num_sql = "select count(*) as totle from user where $where and shopname IS NOT NULL and shopname <> '' and userid=shopid  ";
//var_dump($totle_num_sql);die;
$totle = $db->query($totle_num_sql)[0]['totle'];
//var_dump($totle);die;
$sql = "select shopid,shopname,phone from user where $where and shopname IS NOT NULL  and shopname <> '' and userid=shopid  order by userid asc limit $start,$page_num ";
//var_dump($sql);die;
//执行SQL语句
$data = $db->query($sql);
echo $base->_res("0", $totle, $data);

