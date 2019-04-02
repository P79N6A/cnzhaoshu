<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/11/20
 * Time: 13:37
 * 待加入店铺接口
 */
header('Access-Control-Allow-Origin:*');
include "../../com/db.php";

include "../define_attr/BaseController.php";

$base = new BaseController();

$db = new db();

$shopid = $_POST['shopid'] ? $_POST['shopid'] : "";

$shopname = $_POST['shopname'] ? $_POST['shopname'] : "";

$phone = $_POST['phone'] ? $_POST['phone'] : "";

$p = isset($_POST['page']) ? $_POST['page'] : "1";

//页面展示条数
$page_num = isset($_POST['limit'])?$_POST['limit'] :"";
//开始位置
$start = ($p - 1) * $page_num;
if($phone==""  && $shopname == ""){

    echo $base->_res('6', 0, []);die;

}
$where= " userid <> '" . $shopid . "' and shopid <> '".$shopid."'";

if ($shopname == "") {

    $where .= "";

} else {

    $where .= " and shopname like '%" . $shopname . "%'";

}

if ($phone == "") {

    $where .= "";

} else {

    $where .= " and phone = '" . $phone . "'";

}

$sql = "select shopname,phone,userid, shopid from user where $where  order by userid asc limit $start,$page_num";
//var_dump($sql);die;
$data = $db->query($sql);
$count_sql="select shopname,phone,userid, shopid from user where $where ";
$res=$db->query($count_sql);
$count=count($res);
echo $base->_res('0',$count, $data);