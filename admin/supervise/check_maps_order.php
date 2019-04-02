<?php
/**
 * @Author: anchen
 * @Date:   2018-11-29 09:46:41
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-24 16:22:02
 * 上传交易监管信息的时候判断苗木信息
 */
require "../../com/db.php";
require "./public_function.php";
Access_Header(); // header头信息
// 获取userID和角色id
$user    = json_decode($_COOKIE['user2'],true);
$userid  = isset($user['userid'])?$user['userid']:"";
$id      = isset($_POST['id'])?$_POST['id']:"";

$db= new db();
// 查询苗木的基本信息
$sql = 'select id,tree_name,dbh,crown,plant_height,qrcode,state from maps_order where id=?';

$data = $db->prepare_query($sql,array($id));
// 查找二维码绑定了多少棵树
$sql = "select count(id) as sum from maps_order where  qrcode = '".$data[0]['qrcode']."'";

$newdata['info']['sum'] = $db->query($sql)[0]['sum'];
// 数组处理
foreach ($data as $key => $val) {
    $newdata['info']['id'] = $val['id'];
    $newdata['info']['tree_name'] = $val['tree_name'];
    $newdata['info']['dbh'] = $val['dbh'].'公分';
    $newdata['info']['crown'] = $val['crown'].'米';
    $newdata['info']['plant_height'] = $val['plant_height'].'米';
    $newdata['info']['qrcode'] = $val['qrcode'];
    $newdata['state'] = $val['state'];
}
unset($data);
// 查询当前用户名称和联系电话
$sql = "select name,phone from user where userid = '$userid'";

$newdata['user'] = $db->query($sql)[0];

$newdata = _unsetNull($newdata);

unset($db);

echo json_encode($newdata);