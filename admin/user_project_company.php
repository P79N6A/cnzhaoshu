<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/9/27
 * Time: 14:47
 * USED: 创建当前用户 所在公司得 所有项目信息
 */

include  "../com/db.php";

$db=new db();
$user=json_decode($_COOKIE['user2'],true);

if($user['userid']!=1){
    $user=$user['userid'];
    $contract_info_sql="select company_name from contract_info where userid='".$user."' ";
}else{
    $contract_info_sql="select company_name from contract_info ";
}

$contract_info=$db->query($contract_info_sql);

$count_contract_info=count($contract_info);

for($e=0;$e<$count_contract_info;$e++){
    $company_project_sql="select * from order_project where partya_company_name='".$contract_info[$e]['company_name']."'and status=2 order by project_time desc";

    $company_project[]=$db->query($company_project_sql);
    if(empty($company_project[$e])){
        unset($company_project[$e]);
    }
}

$company_info=[];
foreach($company_project as $k=>$v){
    foreach ($v as $key=>$val){
        $company_info[]=$val;
    }
}

$company_count=count($company_info);

for($i=0;$i<$company_count;$i++){
    $tree_info_sql="select * from new_tree_order where project='".$company_info[$i]['project_id']."'";
    $company_info[$i]['tree_info']=$db->query($tree_info_sql);
    $contacts_sql="select contacts from contract_info where company_name='".$company_info[$i]['partya_company_name']."'";
    $company_info[$i]['contacts']=$db->query($contacts_sql)[0];
}
//$d="";
//
//for($d=0;$d<count($company_info);$d++){
//
//    for($y=0;$y<count($company_info[$d]['tree_info']);){
//
//        if($company_info[$d]['tree_info'][$y]['adop_num']<0){
//            $company_info[$d]['tree_info'][$y]['adop_num']=0;
//        }
//    }
//}

unset($db);
echo json_encode($company_info);
