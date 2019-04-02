<?php
//修改项目状态接口
include "../com/db.php";

$project_id=isset($_POST['project_id'])?$_POST['project_id']:"";

$status=isset($_POST['status'])?$_POST['status']:"";

$db=new db();

$sql="update order_project set status ='".$status."' where project_id='".$project_id."'";

$tree_sql="update new_tree_order set status ='".$status."' where project='".$project_id."'";

$red=$db->exec($tree_sql);

$res=$db->exec($sql);

if(!$res){
	
    $content=[
	
      'status'=>1,
	  
      'data'=>"修改失败"
		
    ];
	
}else{
	
    $content=[
	
        'status'=>0,
		
        'data'=>"修改成功"
		
    ];
	
}
echo json_encode($content);