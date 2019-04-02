<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/8/13
 * Time: 10:51
 */

include "../com/db.php";

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

if(!empty($party_A['company_name'])&&empty($party_B['company_name'])){

    update_project($project_id,$party_A['company_name'],$party_B['company_name'],$data['postData']['third_party_receivables'],$data['postData']['ring_price'],$data['postData']['begin_time'],$data['postData']['end_time'],$data['postData']['ring_num'],$hcity,$hproper,$harea);
    //存入招标表
    insert_tender($project_id,$party_A['company_name']);

    insert_table($party_A['company_name'],$party_A['representative'],$party_A['open_bank'],$party_A['bank_num'],$party_A['duty_paragraph'],$party_A['address'],$party_A['tel'],$party_A['contacts']);
    //获得所推送的项目 id 用户id 树名 还有 openid
    get_all($project_id);
    //生成招标二维码的连接
    $content=[
        //需要修改的地方
        'url'=>'http://test.cnzhaoshu.com/admin/testjson2.php?project_id='.$project_id
    ];

    echo json_encode($content);

}else{

    insert_table($party_A['company_name'],$party_A['representative'],$party_A['open_bank'],$party_A['bank_num'],$party_A['duty_paragraph'],$party_A['address'],$party_A['tel'],$party_A['contacts']);

    insert_tab($party_B['company_name'],$party_B['representative'],$party_B['open_bank'],$party_B['bank_num'],$party_B['duty_paragraph'],$party_B['address'],$party_B['tel'],$party_B['contacts']);

    update_project($project_id,$party_A['company_name'],$party_B['company_name'],$data['postData']['third_party_receivables'],$data['postData']['ring_price'],$data['postData']['begin_time'],$data['postData']['end_time'],$data['postData']['ring_num'],$hcity,$hproper,$harea,$signing_time);

    update_tree($project_id);

    $content=[

        'status'=>0,

        'url'=>'http://test.cnzhaoshu.com/admin/create_contract.php?project_id='.$project_id

    ];

    echo json_encode($content);
}
//修改生成合同的树木的状态
function update_tree($project_id=""){

    $db=new db();

    $update_tree_status_sql="update new_tree_order set contract_status ='1' where project='".$project_id."' ";

    $db->exec($update_tree_status_sql);

}

//存入与修改项目表中的数据
function insert_table($company_name="",$representative="",$open_bank="",$bank_num="",$duty_paragraph="",$address="",$tel="",$contacts=""){
    //调用拼音接口
    $db= new  db();

    $select_company="select contract_id from  contract_info where company_name='".$company_name."'";

    $res=$db->query($select_company);

    if(empty($res)) {

        include "../com/pinyin.php";

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

        include "../com/pinyin.php";

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

        $status=1;

        $sql=" update order_project set partya_company_name='".$party_A."' ,partyb_company_name='".$party_B."',third_party_receivables='".$thhird_party_receivables."',ring_price='".$ring_price."',ring_num='".$ring_num."',begin_time='".$begin_time."',end_time='".$end_time."',create_time='".$create_time."',status='".$status."',hcity='".$hcity."',hproper='".$hproper."',harea='".$harea."' ,order_num='".$order_num."', Up_time='".$Up_time."' ,signing_time='".$signing_time."' where project_id=$project_id";

        $db->exec($sql);

        $sqll="select * from order_project where project_id = '".$project_id."'";

        $project=$db->query($sqll)[0];

        $sqli="update new_tree_order set status='".$status."',Up_time='".$Up_time."',hcity='".$project['hcity']."',hproper='".$project['hproper']."',harea='".$project['harea']."' where project='".$project_id."'";

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

//获取采购单所有名称 并与tree表数据进行比对 获取user表中的openid
function get_all($project_id){

    include "../wechat/send-message-template2.php";

    $db= new db();

    $sql="select tree_name,plant_height, crown, dbh, tree_order_id from new_tree_order where project='".$project_id."'";
    $data=$db ->query($sql);
//        var_dump($data);die;
    $count=count($data);
    $project_name_sql="select project_name ,partya_company_name from order_project where project_id='".$project_id."'";

    $project=$db->query($project_name_sql)[0];

    $project_name=$project['project_name'];

    $contacts_sql="select contacts from contract_info where company_name ='".$project['partya_company_name']."'";

    $contacts=$db->query($contacts_sql)[0]['contacts'];

    $where="";

    for($i=0;$i<$count;$i++){

        $plant_height[]=$data[$i]['plant_height'];
//        var_dump($plant_height);die;
        if(!empty($plant_height[0])){

            if(strpos($plant_height[$i],"-")){

                $plant_max[]=strtok($plant_height[$i], '-');

                $plant_min[]=substr($plant_height[$i],strripos($plant_height[$i],"-")+1);

            }else{

                $plant_max[]=$plant_height[$i];

                $plant_min[]=$plant_height[$i];

            }

            $where.=" and height between '".$plant_max[$i]."'and '".$plant_min[$i]."'";

        }else{

            $where.="";

        }

        $crown[]=$data[$i]['crown'];

        if(!empty($crown[0])){

            if(strpos($crown[$i],"-")){

                $crown_max[]=strtok($count[$i],'-')?0:strtok($count[$i],'-');

                $crown_min[]=substr($crown[$i],strripos($crown[$i],"-")+1);

            }else{

                $crown_max[]=$crown[$i];

                $crown_min[]=$crown[$i];

            }

            $where.=" and crownwidth between '".$crown_max[$i]."' and  '".$crown_min[$i]."'";

        }else{

            $where.="";

        }

        $dbh[]=$data[$i]['dbh'];

        if(!empty($dbh['0'])){

            $where.= "and dbh ='".$data[$i]['dbh']."'";

        }else{

            $where.="";

        }

        $sqli="select name,userid from tree where name='".$data[$i]['tree_name']."' $where ";

        $where="";

        $res[]=$db->query($sqli);

        $name_count[]=count($res[$i]);

        for($j=0;$j<$name_count[$i];$j++){

            $sqls="select wechatid,name from user where userid='".$res[$i][$j]['userid']."' and get_msg=1 ";

            $sqls_data=$db->query($sqls)[0];

            $res[$i][$j]['tree_order_id']=$data[$i]['tree_order_id'];

            $res[$i][$j]['wechatid']=$sqls_data['wechatid'];

            $res[$i][$j]['project_id']=$project_id;

            $res[$i][$j]['project_name']=$project_name;

            $res[$i][$j]['contacts']=$contacts;

            if(!isset($res[$i][$j]['wechatid'])){

                unset($res[$i][$j]);

            }

        }

        if(empty($res[$i])){

            unset($res[$i]);

        }

    }
//    var_dump($res);die;
    $e=0;

    $info=[];

    foreach ($res as $k=>$v){

        foreach ($v as $key=>$val){

            $info[$e]=$val;

            $e++;

        }
    }
    $count_info=count($info);

    for($c=0;$c<$count_info;$c++){

        send_message($info[$c]['wechatid'],$info[$c]['tree_order_id'],"采购单里有您的苗木，欢迎报价!",$info[$c]['project_name'],$info[$c]['contacts'],date("Y-m-d",time()),"找树网提供");

    }

}



