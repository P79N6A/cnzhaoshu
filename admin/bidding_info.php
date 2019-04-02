<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/9/5
 * Time: 9:17
 */
//调取投标页面接口

include "../com/db.php";

$db=new db();

$tree_id=isset($_POST['tree_id'])?$_POST['tree_id']:"";

$user=json_decode($_COOKIE['user2'],true);

$userid=$user['userid'];

$isnull_user_sql="select phone from user where userid='".$userid."'";

$phone=$db->query($isnull_user_sql)[0]['phone'];

if($phone==""){
    $isnull_user=0;
}else{
    $isnull_user=1;
}

$sql="select * from new_tree_order where tree_order_id='".$tree_id."'";

$res=$db->query($sql)[0];

$sqli="select partya_company_name from order_project where project_id='".$res['project']."' ";

$project_name=$db->query($sqli)[0]['partya_company_name'];

$sqll="select * from contract_info where company_name='".$project_name."'";

$res['project_info']=$db->query($sqll)[0];

$sql="select tree_name,plant_height, crown, dbh from new_tree_order where tree_order_id='".$tree_id."'";

$data=$db ->query($sql)[0];

$where="userid='".$userid."' and name ='".$res['tree_name']."'";

if(!empty($data['plant_height'])){

    if(strpos($data['plant_height'],"-")){

        $plant_max=strtok($data['plant_height'], '-');

        $plant_min=substr($data['plant_height'],strripos($data['plant_height'],"-")+1);

    }else{

        $plant_max=$data['plant_height'];

        $plant_min=$data['plant_height'];

    }

    $where.=" and height between '".$plant_max."'and '".$plant_min."'";

}else{

    $where.="";

}

if(!empty($data['crown'])){

    if(strpos($data['crown'],"-")){

        $crown_max=strtok($data['crown'], '-');

        $crown_min=substr($data['crown'],strripos($data['crown'],"-")+1);

    }else{

        $crown_max=$data['crown'];

        $crown_min=$data['crown'];

    }

    $where.=" and crownwidth between '".$crown_max."'and '".$crown_min."'";

}else{

    $where.="";

}

if(!empty($data['dbh'])){

    if(strpos($data['dbh'],"-")){

        $dbh_max=strtok($data['dbh'], '-');

        $dbh_min=substr($data['dbh'],strripos($data['dbh'],"-")+1);

    }else{

        $dbh_max=$data['dbh'];

        $dbh_min=$data['dbh'];

    }

    $where.=" and dbh between '".$dbh_max."'and '".$dbh_min."'";

}else{

    $where.="";

}

$sqlr="select province,city,district,imgpath,price,`count` from tree where $where ";

$des=$db->query($sqlr)[0];

$des['city']=array($des['province'],$des['city'],$des['district']);

$res['tender_info']=array('imgpath'=>$des['imgpath'],'price'=>$des['price'],'count'=>$des['count']);
$count_des=count($des['city']);

if($count_des>1){

    $res['province']=implode(" ",$des['city']);

}else{

    $res['province']=$des['city'];

}
//$sqlr="select province,city,district  from tree where userid='".$userid."' and name ='".$res['tree_name']."'";
//
//$des=$db->query($sqlr)[0];
//
//$count_des=count($des);
//
//if($count_des>1){
//
//    $res['province']=implode(" ",$des);
//
//}else{
//
//    $res['province']=$des;
//
//}


$content=[

    'status'=>0,
	
    'data'=>$res

	,'isnull_user'=>$isnull_user
];

echo json_encode($content);