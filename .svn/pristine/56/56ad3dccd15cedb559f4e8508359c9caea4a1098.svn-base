<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/11/19
 * Time: 15:46
 * 已合并店铺
 */
header('Access-Control-Allow-Origin:*');
include "../../com/db.php";
include "../define_attr/BaseController.php";
$db = new db();
$base = new BaseController();
$shopid = isset($_POST['shopid']) ? $_POST['shopid'] : "";
$shop_info_sql = "select shopid,shopname,userid,phone from user where shopid='" . $shopid . "'";
$shop_info = $db->query($shop_info_sql) == "" ? [] : $db->query($shop_info_sql);
echo $base->_res('0', "检出成功", $shop_info);