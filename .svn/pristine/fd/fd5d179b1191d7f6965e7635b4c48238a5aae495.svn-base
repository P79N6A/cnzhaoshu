<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/8/14
 * Time: 14:16
 */
/**
 * 查询所有企业信息
 *使用方法 include("select_all_enterprise.php");
 * select_all();
 *直接返回所有数据
 *
 * */
select_all();

 function select_all(){
	 
     include "../com/db.php";
	 
     $db=new db();
	 
     $sql="select contract_id,company_name,name_spell from contract_info";
	 
     $data=$db->query($sql);
	 
     echo json_encode($data,JSON_UNESCAPED_UNICODE);
	 
 }