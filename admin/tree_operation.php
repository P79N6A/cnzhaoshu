<?php

include "../com/db.php";

$project_id=isset($_POST['project_id'])?$_POST['project_id']:"";

tree_operation($project_id);

function tree_operation($project_id){

    $db=new db();

    $sql="select count(tree_name) from new_tree_order  where project ='".$project_id."'";

    $count=$db->query($sql)[0]['count(tree_name)'];
    //当前每种树所占百分比
    $percentage=round(1/$count*100,2);  
    //当前项目下所需要多少棵树  
    $sqli="select tree_order_id ,tree_num from new_tree_order where project='".$project_id."'";

    $tree_order=$db->query($sqli);

    for($i=0;$i<count($tree_order);$i++){
        $sqll="select sum(tree_num) ,tender_tree_id from tender_order where tender_tree_id = '".$tree_order[$i]['tree_order_id']."'and tender_status= 2";

        $data[]=$db->query($sqll)[0];

    }
    $sqlis="select * from new_tree_order where project='".$project_id."'";

    $res=$db->query($sqlis);
	
    for($i=0;$i<count($res);$i++){


        $sql_tender_info="select * from tender_order where tender_tree_id='".$res[$i]['tree_order_id']."'";

        $data[$i]['tender_info']=$db->query($sql_tender_info);

        if(!empty($data[$i]['tender_info'])){

            $user_count=count($data[$i]['tender_info']);

            for($e=0;$e<$user_count;$e++){


                $user_sql="select name,phone from user where userid='".$data[$i]['tender_info'][$e]['tender_user_id']."'";


                $data[$i]['tender_info'][$e]['userinfo']=$db->query($user_sql)[0];
				
                $data[$i]['tender_info'][$e]['tree_imgs']=explode(',',$data[$i]['tender_info'][$e]['tree_imgs']);
				
            }

        }
    }
    foreach ($data as $key => $value) {

        $data[$key] = array_merge($value,$res[$key]);
    }
    $content=[

        'status'=>0,

        'data'=>$data

    ];

    echo json_encode($content);

}
?>