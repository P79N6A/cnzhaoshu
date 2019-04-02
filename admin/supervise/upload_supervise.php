<?php
/**
 * Created by PhpStorm.
 * User: Lihzhongyang
 * Date: 2018/8/13
 * Time: 10:51
 */

include "../../com/db.php";
include "../../com/pinyin.php";
include "./public_function.php";
//合同甲乙双方信息 是否入库与修改页面

$data=$_POST;

$hcity=$data['postData']['hcity'];

$hproper=$data['postData']['hproper'];

$harea=$data['postData']['harea'];

$party_A=$data['postData']['partya']['data'];

$party_A_status=$data['postData']['partya']['status'];

$party_B_status=$data['postData']['partyb']['status'];

$party_B=$data['postData']['partyb']['data'];

$party_A_id=isset($party_A['contract_id'])?$party_A['contract_id']:"";

$party_B_id=isset($party_B['contract_id'])?$party_B['contract_id']:"";

$project_id=$data['postData']['project_id'];

$signing_time=isset($data['postData']['signing_time'])?$data['postData']['signing_time']:"";

if(!empty($party_A['company_name'])&&!empty($party_B['company_name'])){

    update_project($project_id,$party_A['company_name'],$party_B['company_name'],$data['postData']['third_party_receivables'],$data['postData']['ring_price'],$data['postData']['begin_time'],$data['postData']['end_time'],$data['postData']['ring_num'],$hcity,$hproper,$harea);
    //存入招标表
    insert_tender($project_id,$party_A['company_name']);
    insert_table($party_A['company_name'],$party_A['representative'],$party_A['open_bank'],$party_A['bank_num'],$party_A['duty_paragraph'],$party_A['address'],$party_A['tel'],$party_A['contacts']);
    insert_tab($party_B['company_name'],$party_B['representative'],$party_B['open_bank'],$party_B['bank_num'],$party_B['duty_paragraph'],$party_B['address'],$party_B['tel'],$party_B['contacts']);
    //乙方投标
    $res = insert_tender_order($project_id,$party_B['company_name'],$party_B['address'],$party_B['tel'],$party_B['contacts']);
     if($res == 1){
        _res(1,'录入采购监管成功');
     }else{
        _res(1,'录入采购监管失败');
     }  

}else{
    _res(0,'请完善甲乙双方信息');
}

//存入与修改项目表中的数据
function insert_table($company_name="",$representative="",$open_bank="",$bank_num="",$duty_paragraph="",$address="",$tel="",$contacts=""){
    //调用拼音接口
    $db= new  db();

    $select_company="select contract_id from  contract_info where company_name='".$company_name."'";

    $res=$db->query($select_company);

    if(empty($res)) {

        if(!empty($company_name)){

            $name_spell=getPinyin($company_name);

        }else{

            $name_spell="";

        }

        $user_sql="select userid from user  where phone='".$tel."'";

        $user_id=$db->query($user_sql);

        if(!empty($user_id['0'])){

            $user_id=$user_id['0']['userid'];

        }else{

            $user_id="";

        }

        $sql = "insert into contract_info(company_name,name_spell,representative,open_bank,bank_num,duty_paragraph,address,tel,userid,contacts) values ('" . $company_name . "','" . $name_spell . "','" . $representative . "','" . $open_bank . "','" . $bank_num . "','" . $duty_paragraph . "','" . $address . "','" . $tel . "','" . $user_id . "','".$contacts."')";

    }else{

        $user_sql="select userid from user  where phone='".$tel."'";

        $user_id=$db->query($user_sql);

        if(!empty($user_id['0'])){

            $user_id=$user_id['0']['userid'];

        }else{

            $user_id="";

        }

        $contract_id=$res[0]['contract_id'];

        $sql="update contract_info set company_name='".$company_name."' ,representative='".$representative."',open_bank='".$open_bank."',bank_num='".$bank_num."',duty_paragraph='".$duty_paragraph."',address='".$address."',tel='".$tel."',userid='".$user_id."',contacts='".$contacts."' where contract_id=$contract_id";

    }

    $db->exec($sql);

}

function insert_tab($company_name="",$representative="",$open_bank="",$bank_num="",$duty_paragraph="",$address="",$tel="",$contacts=""){
    //调用拼音接口
    $db= new  db();

    $select_company="select contract_id from  contract_info where company_name='".$company_name."'";

    $res=$db->query($select_company);

    if(empty($res)) {

        if(!empty($company_name)){

            $name_spell=getPinyin($company_name);

        }else{

            $name_spell="";

        }

        $user_sql="select userid from user  where phone='".$tel."'";

        $user_id=$db->query($user_sql);

        if(!empty($user_id['0'])){

            $user_id=$user_id['0']['userid'];

        }else{

            $user_id="";

        }

        $sql = "insert into contract_info(company_name,name_spell,representative,open_bank,bank_num,duty_paragraph,address,tel,userid,contacts) values ('" . $company_name . "','" . $name_spell . "','" . $representative . "','" . $open_bank . "','" . $bank_num . "','" . $duty_paragraph . "','" . $address . "','" . $tel . "','" . $user_id . "','".$contacts."')";

    }else{

        $user_sql="select userid from user  where phone='".$tel."'";

        $user_id=$db->query($user_sql);

        if(!empty($user_id['0'])){

            $user_id=$user_id['0']['userid'];

        }else{

            $user_id="";

        }

        $contract_id=$res[0]['contract_id'];

        $sql="update contract_info set company_name='".$company_name."' ,representative='".$representative."',open_bank='".$open_bank."',bank_num='".$bank_num."',duty_paragraph='".$duty_paragraph."',address='".$address."',tel='".$tel."',userid='".$user_id."',contacts='".$contacts."' where contract_id=$contract_id";

    }

    $db->exec($sql);

}
//修改项目订单表甲乙双方信息
function update_project($project_id="",$party_A="",$party_B="",$thhird_party_receivables="",$ring_price="",$begin_time="",$end_time="",$ring_num="",$hcity="",$hproper="",$harea="",$signing_time=""){

    $db= new  db();

    $create_time=date("Y-m-d H:i:s",time());

    $Up_time=date("Y-m-d H:i:s",time()+30*86400);

    $order_num=date("Ymd",time()).$project_id;

    if(empty($party_B)){

        $status=2;

        $sql=" update order_project set partya_company_name='".$party_A."',third_party_receivables='".$thhird_party_receivables."',ring_price='".$ring_price."',begin_time='".$begin_time."',ring_num='".$ring_num."',end_time='".$end_time."',create_time='".$create_time."',status='".$status."',hcity='".$hcity."',hproper='".$hproper."',harea='".$harea."',Up_time='".$Up_time."',order_num='".$order_num."',signing_time='".$signing_time."' where project_id=$project_id";

        $db->exec($sql);

        $sqll="select * from order_project where project_id = '".$project_id."'";

        $project=$db->query($sqll)[0];

        $sqli="update new_tree_order set status='".$status."',Up_time='".$Up_time."',hcity='".$project['hcity']."',hproper='".$project['hproper']."',harea='".$project['harea']."'  where project='".$project_id."'";
        $delete_sql="delete from order_project where partya_company_name is null ";
        $db->exec($delete_sql);

    }else{

        $sql=" update order_project set partya_company_name='".$party_A."' ,partyb_company_name='".$party_B."',third_party_receivables='".$thhird_party_receivables."',ring_price='".$ring_price."',ring_num='".$ring_num."',begin_time='".$begin_time."',end_time='".$end_time."',create_time='".$create_time."',status='3',hcity='".$hcity."',hproper='".$hproper."',harea='".$harea."' ,order_num='".$order_num."', Up_time='".$Up_time."' ,signing_time='".$signing_time."' where project_id=$project_id";

        $db->exec($sql);

        $sqll="select * from order_project where project_id = '".$project_id."'";

        $project=$db->query($sqll)[0];

        $sqli="update new_tree_order set status='1',Up_time='".$Up_time."',hcity='".$project['hcity']."',hproper='".$project['hproper']."',harea='".$project['harea']."' where project='".$project_id."'";

    }

    $db->exec($sqli);
    $delete_sql="delete from order_project where partya_company_name is null ";
    $db->exec($delete_sql);
    unset($db);
}
//存入招标信息表
function insert_tender($project_id="",$party_A=""){

    $tender_create_time=time();

    $tender_end_time=time()+86400*30;

    $sql= "insert into tender(tender_project_id,partya_company_name,tender_create_time,tender_end_time) values ('" . $project_id . "','" . $party_A . "','" . $tender_create_time . "','" . $tender_end_time . "')";

    $db= new db();

    $db->exec($sql);

    unset($db);
}
//乙方投标
function insert_tender_order($project_id='',$company_name='',$address='',$tel='',$contacts=''){
   
    $db= new db();
    //查询苗木id
    $tree_id_sql = "select tree_order_id,tree_num from new_tree_order where project = '$project_id' limit 1";

    $tree_info  = $db->query($tree_id_sql)[0];
    //查询乙方的userid
    $user_sql="select userid from user  where phone='".$tel."'";
    $userid = $db->query($user_sql)[0]['userid'];
    //投标树信息
    $tree_num  = $tree_info['tree_num'];
    $tree_id  = $tree_info['tree_order_id'];
    $tree_price  = '100';
    $tender_time=date("Y-m-d H:i:s",time());
    $tender_status=2; //投标状态1为未审核2.为审核通过,3为舍弃
    $adoption_status = 1; //采用状态 1为采用 0为不采用
    $tree_imgs = './img\logo0.jpg';
    $sql="insert into tender_order(tender_tree_id,tender_user_id,tree_price,tree_num,tree_imgs,tree_address,tender_time,tender_status,project,adoption_status) values ('".$tree_id."','".$userid."','".$tree_price."','".$tree_num."','".$tree_imgs."','".$address."','".$tender_time."','".$tender_status."','".$project_id."','".$adoption_status."')";
    $res = $db->insert($sql);
    unset($db);
    if($res){
        return 1;
    }else{
        return 2;
    }

}
