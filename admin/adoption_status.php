<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/9/29
 * Time: 11:44
 *
 */
include "../com/db.php";
$db=new db();
$tender_tree_id=isset($_POST['tender_order_id'])?$_POST['tender_order_id']:"";

$adoption_status=isset($_POST['adoption_status'])?$_POST['adoption_status']:"";

$tender_status_sql="select tender_status, tender_tree_id,project from tender_order where tender_order_id='".$tender_tree_id."'";

$tender=$db->query($tender_status_sql);

$tender_status=$tender['0']['tender_status'];

$tree_order_id=$tender['0']['tender_tree_id'];

$project=$tender['0']['project'];

if($tender_status==2 && $adoption_status==1){

    $update_adoption_sql="update tender_order set adoption_status='".$adoption_status."',tender_status=2  where tender_order_id ='".$tender_tree_id."' ";

    $update_adoption_num_sql="update new_tree_order set adop_num = if((adop_num -1)<0,0,(adop_num-1)),tree_un_audits = if((tree_un_audits -1)<0,0,(tree_un_audits-1)),tree_un_audits = 0,tree_oked_audits=(tree_oked_audits+1) where tree_order_id='".$tree_order_id."' ";

    $sum_sql="select sum(tree_un_audits) as sum_audits from new_tree_order where project ='".$project."'";
    $sum=$db->query($sum_sql)['sum_audits'];
    $update_audits_sql="update order_project set audits_num='".$sum."'";
    $db->exec($update_audits_sql);
    $update_adoption_oked_num_sql="update order_project set audits_num=if((audits_num-1)<0,0,(audits_num-1)) where project_id='".$project."'";

    $db->exec($update_adoption_oked_num_sql);

}else if($tender_status==2 && $adoption_status==0){

    $update_adoption_sql="update tender_order set adoption_status='".$adoption_status."' where tender_order_id ='".$tender_tree_id."' ";
    $update_adoption_num_sql="update new_tree_order set adop_num = (adop_num +1) where tree_order_id='".$tree_order_id."' ";

}else if($adoption_status==1){

    $update_adoption_sql="update tender_order set adoption_status='".$adoption_status."' where tender_order_id ='".$tender_tree_id."' ";

    $update_adoption_num_sql="update new_tree_order set adop_num = if((adop_num -1)<0,0,(adop_num-1)),tree_un_audits = if((tree_un_audits -1)<0,0,(tree_un_audits-1)),tree_un_audits = 0,tree_oked_audits=(tree_oked_audits+1) where tree_order_id='".$tree_order_id."' ";


    $update_adoption_oked_num_sql="update order_project set audits_num=if((audits_num-1)<0,0,(audits_num-1)) where project_id='".$project."'";
    $sum_sql="select sum(tree_un_audits) as sum_audits from new_tree_order where project ='".$project."'";
    $sum=$db->query($sum_sql)['sum_audits'];
    $update_audits_sql="update order_project set audits_num='".$sum."'";
    $db->exec($update_audits_sql);

    $db->exec($update_adoption_oked_num_sql);

}else{
    $update_adoption_sql="update tender_order set adoption_status='".$adoption_status."' where tender_order_id ='".$tender_tree_id."' ";
    $sum_sql="select sum(tree_un_audits) as sum_audits from new_tree_order where project ='".$project."'";
    $sum=$db->query($sum_sql)['sum_audits'];
    $update_audits_sql="update order_project set audits_num='".$sum."'";
    $db->exec($update_audits_sql);
}

$res=$db->exec($update_adoption_sql);

$update_adoption_num=$db->exec($update_adoption_num_sql);

$tender_tree_id_sql="select tender_tree_id from tender_order where tender_order_id='".$tender_tree_id."'";

$tender_treee_id=$db->query($tender_tree_id_sql)[0]['tender_tree_id'];

$shop_tree_num_sql="select sum(tree_num) as shop_tree_sum from tender_order where tender_tree_id ='".$tender_treee_id."' and adoption_status='1'";

$shop_tree_num=$db->query($shop_tree_num_sql)[0]['shop_tree_sum'];

$update_tree_sum_sql="update new_tree_order set adoption_num='".$shop_tree_num."' where tree_order_id ='".$tender_treee_id."'";

$carry=$db->exec($update_tree_sum_sql);

if($carry){
    $content=[
        "status"=>0
    ];
}else{
    $content=[
        "status"=>1
    ];
}
echo json_encode($content);