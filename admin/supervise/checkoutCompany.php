<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-22 14:11:19
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-24 16:29:51
 * 生成合同的时候检测乙方身份,如果有企业信息，直接生成合同
 */

require "../../com/db.php";
require "./public_function.php";
Access_Header(); // header头信息
$db= new db();

$tender_order_id = isset($_POST['tender_order_id'])?$_POST['tender_order_id']:"";

if($tender_order_id == ''){
    _res(1,'非法请求接口');
}
// 根据投标的订单id 查找招标的项目id和userID
$sql="select b.company_name from tender_order a left join contract_info b on a.tender_user_id = b.userid where  a.tender_order_id = '".$tender_order_id."'";

$res=$db->query($sql)[0]['company_name'];

unset($db);

if(!$res){

    _res(1,'投标方还没有录入企业信息');

}else{

    _res(0,'/admin/supervise/create_contract.php?tender_order_id='.$tender_order_id);

}