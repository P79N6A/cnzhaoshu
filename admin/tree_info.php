<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/9/5
 * Time: 9:17
 */
//调取投标页面接口
include "../com/db.php";
require "./supervise/public_function.php";
Access_Header(); // header头信息
$db=new db();

$tree_id=$_POST['tree_id'];

$user=json_decode($_COOKIE['user2'],true);

$userid=$user['userid'];

$tree_name=isset($_POST['tree_name'])?$_POST['tree_name']:"";

$db=new db();

$sql="select tree_name,plant_height, crown, dbh from new_tree_order where tree_order_id='".$tree_id."'";

$data=$db ->query($sql)[0];

$where="userid='".$userid."' and name ='".$tree_name."'";

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

//$sqlr="select province,city,district,imgpath,price,`count` from tree where treeid=10006 ";


$des=$db->query($sqlr)[0];

$count_des=count($des);

if($count_des>1){
	
    $des=$des;
	
}else{
	
    $res['province']=$des;
	
}

$sqlo="select * from tender_order where tender_user_id ='".$userid."' and tender_tree_id = '".$tree_id."'";

$res['tender_info']= $db->query($sqlo)[0];

$content=[

    'status'=>0,
	
    'data'=>$res,
	
    'nursery'=>$des
	
];

echo json_encode($content);