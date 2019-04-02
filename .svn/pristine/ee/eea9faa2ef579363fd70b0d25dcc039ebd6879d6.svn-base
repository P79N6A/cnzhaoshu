<?php
header('Content-type: text/html;charset=utf-8');
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/8/10
 * Time: 15:08
 */

//查询公司信息
include('../com/db.php');

$company_name=$_POST['company_name'];

$db=new db();

$sql="select * from contract_info where `company_name`='".$company_name."'";

$res=$db->query($sql);

if(empty($res)){
	
    $content=[
	
        'status'=>1,
		
        'msg'=>"没有检测到该公司"
		
    ];

}else{
	
    $content=[
	
        'status'=>0,
		
        'msg'=>$res[0]
		
    ];
}
echo json_encode($content);
