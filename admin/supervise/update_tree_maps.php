<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-28 13:24:20
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-25 13:57:05
 * 二次绑定树牌接口
 */
require "../../com/db.php";
require "./public_function.php";
include "./Loginterface.php";
Access_Header(); // header头信息
$db = new db();
$data = $_POST;
// 树木名称
$tree_name = isset($data['tree_name'])?$data['tree_name']:"";
// 树木备注
$tree_attribute = isset($data['tree_attribute'])?$data['tree_attribute']:"";
// 胸径
$dbh = isset($data['dbh'])?$data['dbh']:"";
// 冠幅
$crown = isset($data['crown'])?$data['crown']:"";
// 树木株高
$plant_height = isset($data['plant_height'])?$data['plant_height']:"";
// 树木分支点高
$high_branch_point = isset($data['high_branch_point'])?$data['high_branch_point']:"";

$ground_diameter = isset($data['ground_diameter'])?$data['ground_diameter']:"";
// 树木单位
$company = isset($data['company'])?$data['company']:"株";
// id
$maps_order_id = isset($data['id'])?$data['id']:"";
// photo
$photo = isset($data['photo'])?implode(',',$data['photo']):"";

Loginterface::start( 'tree-maps' );
//生成日志文件
$requestData = '写入时间：'.date('Y-m-d H:i:s').':  '.json_encode($data);

Loginterface::add( $requestData);

unset($data);
// 设置状态
$binding_status = 2;

if(check_qrcode($maps_order_id) == 2){
    //生成日志文件
    $requestData = '写入时间：'.date('Y-m-d H:i:s').':  '.json_encode(array('status' => 1,'msg'=>'二维码已经被占用'));

    Loginterface::add( $requestData);
    
    Loginterface::end();

    _res(1,'二维码已经被占用');

}

$sql = "update maps_order set tree_name =?,tree_attribute =?,dbh =?,crown =?,plant_height =?,high_branch_point = ?,company =?,photo=?,binding_status=?,ground_diameter=?,state = if((state+1)>5,5,(state+1)) where id =?";

$result = $db->prepare_exec($sql,array($tree_name,$tree_attribute,$dbh,$crown,$plant_height,$high_branch_point,$company,$photo,$binding_status,$ground_diameter,$maps_order_id));

unset($db);

if($result){
    //生成日志文件
    $requestData = '写入时间：'.date('Y-m-d H:i:s').':  '.json_encode(array('status' => 0,'msg'=>'二次绑定成功'));

    Loginterface::add( $requestData);

    Loginterface::end();

    _res(0,'二次绑定成功');

}else{
    //生成日志文件
    $requestData = '写入时间：'.date('Y-m-d H:i:s').':  '.json_encode(array('status' => 1,'msg'=>'二次绑定失败，请稍后重试'));

    Loginterface::add( $requestData);

    Loginterface::end();

    _res(1,'二次绑定失败，请稍后重试');

}


