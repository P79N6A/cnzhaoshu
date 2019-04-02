<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/9/26
 * Time: 15:16
 */




//include "../wechat/send-message-custom.php";
//获取采购单所有名称 并与tree表数据进行比对 获取user表中的openid


$project_id=isset($_POST['project'])?$_POST['project']:"";

get_all($project_id);

function get_all($project_id){
	
    $weObj=new Wechat();
	
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
	
    for($i=0;$i<$count;$i++){

        $plant_height[]=$data[$i]['plant_height'];
		
        if(strpos($plant_height[$i],"-")){
			
            $plant_max[]=strtok($plant_height[$i], '-');
			
            $plant_min[]=substr($plant_height[$i],strripos($plant_height[$i],"-")+1);
			
        }else{
			
            $plant_max[]=$plant_height[$i];
			
            $plant_min[]=$plant_height[$i];
		
        }
        $crown[]=$data[$i]['crown'];
		
        if(strpos($crown[$i],"-")){
			
            $crown_max[]=strtok($count[$i],'-')?0:strtok($count[$i],'-');
			
            $crown_min[]=substr($crown[$i],strripos($crown[$i],"-")+1);
			
        }else{
			
            $crown_max[]=$crown[$i];
			
            $crown_min[]=$crown[$i];
			
        }

        $sqli="select name,userid from tree where name='".$data[$i]['tree_name']."'  and crownwidth between '".$crown_max[$i]."' and  '".$crown_min[$i]."' and height between '".$plant_max[$i]."' and '".$plant_min[$i]."' and dbh='".$data[$i]['dbh']."'";

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
		
      	  sendselectedMessage($info[$c]['wechatid'],"您的苗木已被比中 , 欢迎报价!",$info[$c]['project_name'],$info[$c]['contacts'],"找树网","admin/m_bid.html#bidinfo&tree_id='".$info[$c]['tree_order_id']."'&tree_name='".$info[$i]['name']."'
",$weObj);

    }
}