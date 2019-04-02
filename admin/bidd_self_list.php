<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/11/7
 * Time: 18:04
 * 分享后的获得的树木接口
 */
include "../com/db.php";

$db= new db();

$project_id=isset($_POST['project_id'])?$_POST['project_id']:"";

$data_sql="select * from new_tree_order where project ='".$project_id."'";

$data=$db->query($data_sql);

$project_sql="select * from order_project where project_id='".$project_id."'";

$project=$db->query($project_sql)[0];

$sqle="select contacts from contract_info where company_name='".$project['partya_company_name']."'";

$sqle_data=$db->query($sqle)[0]['contacts'];

$count_data=count($data);

for($i=0;$i<$count_data;$i++){

$data[$i]['project_info']=$project;

$data[$i]['contacts']=$sqle_data;

}

$content=[

    'status'=>0,

    'data'=>$data,

    'subscribe'=>1

];
echo json_encode($content);die;