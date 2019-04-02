<?php

/**
 * Created by PhpStorm.
 * User: lizhongyang
 * Date: 2018/8/13
 * Time: 10:51
 * 完善乙方信息，并且下载合同
 */
require "../../com/db.php";
require "./public_function.php";

Access_Header(); // header头信息
$data=$_POST;

// 判断是否非法请求接口
if(empty($data)){

    _res(1,'非法请求接口');

}
// 判断接值

// 判断公司名称
$company_name=isset($data['company_name'])?$data['company_name']:"";
// 判断法人代表
$representative=isset($data['representative'])?$data['representative']:"";
// 判断开户银行
$open_bank=isset($data['open_bank'])?$data['open_bank']:"";
// 判断银行账户
$bank_num=isset($data['bank_num'])?$data['bank_num']:"";
// 判断税号
$duty_paragraph=isset($data['duty_paragraph'])?$data['duty_paragraph']:"";
// 判断地址
$address=isset($data['address'])?$data['address']:"";
// 判断联系人
$contacts=isset($data['contacts'])?$data['contacts']:"";
// 判断联系方式
$tel=isset($data['tel'])?$data['tel']:"";
// 订单id
$tender_order_id=isset($data['tender_order_id'])?$data['tender_order_id']:"";
// 验证必填项
unset($data);
// 判断是否手机号格式不正确
if(!isPhone($tel)){

    _res(1,'联系人手机号格式不正确');

}
// 判断是否公司名称格式不正确
if(!isAllChinese($company_name)){

    _res(1,'公司名称格式不正确');

}
// 判断公司名称是否唯一
if(checkUnique('contract_info','company_name',$company_name)){

    _res(1,'公司名称已存在');

}
// 判断联系人姓名是否全为中文
if(!isAllChinese($contacts)){

    _res(1,'联系人姓名格式不正确');

}
// 判断手机号是否唯一
if(checkUnique('contract_info','tel',$data['tel'])){

    _res(1,'手机号已存在');

}
// 执行添加企业表
$res = insert_table($company_name,$representative,$open_bank,$bank_num,$duty_paragraph,$address,$tel,$contacts,$tender_order_id);

if($res){

    _res(0,'/admin/supervise/create_contract.php?tender_order_id='.$tender_order_id);

}

/**
 * 执行添加企业表
 * @param  string $company_name   公司名称
 * @param  string $representative 法人代表
 * @param  string $open_bank      开户银行
 * @param  string $bank_num       银行账户
 * @param  string $duty_paragraph 税号
 * @param  string $address        地址
 * @param  string $tel            联系方式
 * @param  string $contacts       联系人
 * @param  string $tender_order_id      投标订单id
 * @return int    $res
 */
function insert_table($company_name="",$representative="",$open_bank="",$bank_num="",$duty_paragraph="",$address="",$tel="",$contacts="",$tender_order_id=""){
    $db= new  db();
    //调用拼音接口
    include "../../com/pinyin.php";
    // 判断公司名称是否为空
    if(!empty($company_name)){

        $name_spell=getPinyin($company_name);

    }else{

        $name_spell="";

    }

    $user_sql="select userid from user  where phone='".$tel."'";

    $userid=$db->query($user_sql)['0']['userid'];
    // 判断userID是否为空
    if(empty($userid)){

        _res(1,'此手机号没有关注找树网公众号');

    }
    // 添加企业表
    $sql = "insert into contract_info(company_name,name_spell,representative,open_bank,bank_num,duty_paragraph,address,tel,userid,contacts) values (?,?,?,?,?,?,?,?,?,?)";

    $res = $db->prepare_insert($sql,array($company_name,$name_spell,$representative,$open_bank,$bank_num,$duty_paragraph,$address,$tel,$userid,$contacts));

    if($res){

        return $res;

    }else{

        _res(1,'补录企业信息错误');

    }

}
/**
 * 正则判断是否为中文
 * @param  string  $str
 * @return boolean
 */
function isAllChinese($str){
  if(preg_match('/^[\x7f-\xff]+$/', $str)){
    return true;//全是中文
  }else{
    return false;//不全是中文
  }
}
/**
 * 正则判断是否为电话号码
 * @param  string  $phonenumber
 * @return boolean
 */
function isPhone($phonenumber){
  if(preg_match("/^1[34578]{1}\d{9}$/",$phonenumber)){
      return true;//是电话号码
  }else{
      return false;//不是电话号码
  }
}