<?php
/**
 *   采用之后改变为供应商接口
 * @author lizhongyang
 * @param  (int)tender_order_id  投标的订单的自增id
 * @param  (int)provider_status   投标的订单的自增id
 * @return
 */

include "../../com/db.php";
include "./public_function.php";
Access_Header(); // header头信息
$db = new db();
//订单id
$tender_order_id = isset($_POST['tender_order_id'])?$_POST['tender_order_id']:"";
// 检查是否已经生成合同
$project_id = check_contract($tender_order_id);

if($project_id['status'] == '0'){
    $number=date("YmdHis",time());
    // 添加合同表
    $contract_sql = "insert into contract(project_id,tender_order_id,order_num) values('".$project_id['project_id']."','".$tender_order_id."','".$number."')";

    $db->insert($contract_sql);

}
// 查找项目id，树id，用户id
$sql="select project,tender_tree_id,tender_user_id from tender_order where tender_order_id = '".$tender_order_id."'";

$data=$db->query($sql);
$userid = $data[0]['tender_user_id'];

unset($sql);
// 查找项目名称
$sql2="select project_name from order_project where project_id =".$data[0]['project'];

$project_name=$db->query($sql2);

unset($sql2);

$project_name = $project_name[0]['project_name'];
// 创建时间
$create_time = date('Y-m-d H:i:s');
// 添加订单表
$sql = 'insert into maps(userid,name,create_time,project_id,order_id) values(?,?,?,?,?)';
$result = $db->prepare_insert($sql,array($userid,$project_name,$create_time,$data[0]['project'],$tender_order_id));

unset($sql);
//供应商状态
$provider_status = "1";

$sql = "update tender_order set provider_status=$provider_status where tender_order_id =$tender_order_id ";

$res = $db->exec($sql);

unset($db);

if($res){

    _res(1,'请求成功');

}else{

    _res(0,'请求失败');

}

?>