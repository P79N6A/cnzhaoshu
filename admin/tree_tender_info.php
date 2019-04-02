<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/9/29
 * Time: 9:38
 */
include "../com/db.php";

$db=new db();
//根据树木ID 返还树木投标信息
$tree_id=isset($_POST['tree_id'])?$_POST['tree_id']:"";

$tree_tender_info_sql="select * from tender_order where tender_tree_id='".$tree_id."' ";

$tree_tender_info=$db->query($tree_tender_info_sql);

$count_tree_tender=count($tree_tender_info);

for($i=0;$i<$count_tree_tender;$i++){
	
   $tender_user_sql="select * from user where userid='".$tree_tender_info[$i]['tender_user_id']."'";
   
    $tree_tender_info[$i]['user_info']=$db->query($tender_user_sql);
	
    if(empty($tree_tender_info[$i]['tree_imgs'])){
		
        $tree_tender_info[$i]['tree_imgs']=[];
		
    }else{
		
        $tree_tender_info[$i]['tree_imgs']=explode(',',$tree_tender_info[$i]['tree_imgs']);
		
    }
	
}
unset($db);
echo json_encode($tree_tender_info);