<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-28 13:40:06
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-24 17:18:44
 * 获取当前苗木的采购单名称/合同编号/二维码编号
 */
include "../../com/db.php";
include "./public_function.php";
Access_Header(); // header头信息

$db = new db();

$maps_order_id = $_POST['id'];

// 获取订单id、项目id，二维码编号
$sql = "select a.order_id,a.project_id,b.* from maps a left join maps_order b on a.id = b.map_id where b.id='".$maps_order_id."'";

$maps_data = $db->query($sql)[0];

unset($sql);
// 合同号，项目名称
$sql = "select a.order_num,b.project_name from contract a left join order_project b on a.project_id=b.project_id where tender_order_id = '".$maps_data['order_id']."'";

$contract_data = $db->query($sql)[0];

$contract_data['qrcode_id'] = $maps_data['qrcode'];

$contract_data['tender_order_id'] = $maps_data['order_id'];

$contract_data = _unsetNull($contract_data);
foreach($maps_data as $key =>$val){
    $contract_data[$key] =$val; 
}
// $contract_data['maps_data'] =$maps_data; 
unset($db);

echo json_encode($contract_data);
