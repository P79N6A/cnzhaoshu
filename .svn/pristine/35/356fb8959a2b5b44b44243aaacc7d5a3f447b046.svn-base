<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/7/24
 * Time: 14:43
 * 铺设合同数据
 */
session_start();

$info=$_SESSION['info'];

require_once "./word/PHPWord.php";

require "../com/db.php";

$excelpath=$_POST['filepath'];

$db= new db();

$PHPWord = new PHPWord();

$data=$_POST;

//载入模板文件
$document = $PHPWord->loadTemplate('./word/contract.docx');
//签约时间
$contract_time=date("Y-m-d H:i:s",time());

$sign_time=explode('-',date("Y-m-d",time()));

$sing_year=$sign_time[0];

$sing_month=$sign_time[1];

$sing_day=$sign_time[2];

//获取采购开始时间日期与 采购结束日期

$b_time=explode('-',$info['b_time']);

$b_time_year=$b_time[0];

$b_time_month=$b_time[1];

$b_time_day=$b_time[2];

$s_time=explode('-',$info['s_time']);

$s_time_year=$s_time[0];

$s_time_month=$s_time[1];

$s_time_day=$s_time[2];

$c_price=$info['c_price'];

$ring_price=$info['ring_price'];

//替换Word模板文件中的一处内容，不使用中文的setValue
    $document->setValue('number',$data['number']['0']);
	
    $document->setValue('b_time_year',$b_time_year);
	
    $document->setValue('b_time_month',$b_time_month);
	
    $document->setValue('b_time_day',$b_time_day);
	
    $document->setValue('s_time_year',$s_time_year);
	
    $document->setValue('s_time_month',$s_time_month);
	
    $document->setValue('s_time_day',$b_time_day);
	
    $document->setValue('sign_year',$sing_year);
	
    $document->setValue('A_bank_num',$info['A_bank_num']);
	
    $document->setValue('A_paragraph',$info['A_paragraph']);
	
    $document->setValue('A_fax',$info['A_fax']);
	
    $document->setValue('A_phone',$info['A_phone']);
	
    $document->setValue('A_wechat',$info['A_wechat']);
	
    $document->setValue('A_email',$info['A_email']);
	
    $document->setValue('B_bank_num',$info['B_bank_num']);
	
    $document->setValue('B_paragraph',$info['B_paragraph']);
	
    $document->setValue('B_fax',$info['B_fax']);
	
    $document->setValue('B_phone',$info['B_phone']);
	
    $document->setValue('B_wechat',$info['B_wechat']);
	
    $document->setValue('B_email',$info['B_email']);
	
    $document->setValue('sign_month',$sing_month);
	
    $document->setValue('sign_day',$sing_day);
	
    $document->setValue('c_price',$c_price);
	
    $document->setValue('ring_price',$ring_price);
	
    $document->setValue('dbh',$data['dbh']['0']);
	
    $document->setValue('crown',$data['crown']['0']);
	
    $document->setValue('price',$data['price']['0']);
	
    $document->setValue('num',$data['num']['0']);
	
    $document->setValue('plant_height',$data['plant_height']['0']);
	//替换Word模板文件中的一处内容，这里如果要显示中文，则必须使用iconv函数
    $document->setValue('tree_name',iconv('utf-8', 'GB2312//IGNORE', $data['tree_name']['0']));   
	
	$document->setValue('party_A',iconv('utf-8', 'GB2312//IGNORE', $info['party_A']));
	
    $document->setValue('A_legal_person',iconv('utf-8', 'GB2312//IGNORE', $info['A_legal_person']));
	
    $document->setValue('B_legal_person',iconv('utf-8', 'GB2312//IGNORE', $info['B_legal_person']));
	
    $document->setValue('A_address',iconv('utf-8', 'GB2312//IGNORE', $info['A_address']));
	
    $document->setValue('B_address',iconv('utf-8', 'GB2312//IGNORE', $info['B_address']));
	
    $document->setValue('A_open_bank',iconv('utf-8', 'GB2312//IGNORE', $info['A_open_bank']));
	
    $document->setValue('B_open_bank',iconv('utf-8', 'GB2312//IGNORE', $info['B_open_bank']));
	
    $document->setValue('company',iconv('utf-8', 'GB2312//IGNORE', $data['company']['0']));
	
    $document->setValue('party_B',iconv('utf-8', 'GB2312//IGNORE', $info['party_B']));
	
    $document->setValue('A_contacts',iconv('utf-8', 'GB2312//IGNORE', $info['A_contacts']));
	
    $document->setValue('B_contacts',iconv('utf-8', 'GB2312//IGNORE', $info['B_contacts']));
	
    $document->setValue('project',iconv('utf-8', 'GB2312//IGNORE', $data['project']));
	
    $document->setValue('remarks',iconv('utf-8', 'GB2312//IGNORE', $data['remarks']['0']));

    $docxfilename = './word/test/world'.time().'.docx';

//保存Word文档
$document->save($docxfilename);

$tarname=substr(md5($data['project']),0,8);
//打包成 文件夹
//合同单号
$contract_number=time().$tarname;

$file = $contract_number.".zip";

$datalist=array($docxfilename,$excelpath);

if(!file_exists($file)){
	
    $zip = new ZipArchive();
	
    if ($zip->open($file, ZipArchive::CREATE)==TRUE) {
		
        foreach( $datalist as $val){
			
            if(file_exists($val)){
				
                $zip->addFile( $val, basename($val));
				
            }
			
        }
		
        $zip->close();
    }
	
}
unset($_SESSION["info"]);

if(!file_exists($file)){
	
    exit("无法找到文件");
	
}

$sql= 'insert into contract(contract_number,party_A,A_legal_person,A_open_bank,A_bank_num,A_paragraph,A_address,A_phone,A_fax,A_contacts,A_wechat,A_email,party_B,B_legal_person,B_open_bank,B_bank_num,B_paragraph,B_address,B_phone,B_fax,B_contacts,B_wechat,B_email,b_time,s_time,c_price,ring_price,contract_time,project_name,contract_path) values ("'.$contract_number.'","'.$info['party_A'].'","'.$info['A_legal_person'].'","'.$info['A_open_bank'].'","'.$info['A_bank_num'].'","'.$info['A_paragraph'].'","'.$info['A_address'].'","'.$info['A_phone'].'","'.$info['A_fax'].'","'.$info['A_contacts'].'","'.$info['A_wechat'].'","'.$info['A_email'].'","'.$info['party_B'].'","'.$info['B_legal_person'].'","'.$info['B_open_bank'].'","'.$info['B_bank_num'].'","'.$info['B_paragraph'].'","'.$info['B_address'].'","'.$info['B_phone'].'","'.$info['B_fax'].'","'.$info['B_contacts'].'","'.$info['B_wechat'].'","'.$info['B_email'].'","'.$info['b_time'].'","'.$info['s_time'].'","'.$info['c_price'].'","'.$info['ring_price'].'","'.$contract_time.'","'.$data['project'].'","'.$file.'")';
//echo  $sql; die;
$res=$db->insert($sql);
//$id=$db->getLastID();
$count=count($_POST['number']);

for($i=0;$i<$count;$i++){
	
    $sqll='insert into contract_order(contract_id,`number`,tree_name,plant_height,dbh,diameter,crown,remarks,company,num,price) values ("'.$res.'","'.$_POST['number'][$i].'","'.$_POST['plant_height'][$i].'","'.$_POST['tree_name'][$i].'","'.$_POST['dbh'][$i].'","'.$_POST['diameter'][$i].'","'.$_POST['crown'][$i].'","'.$_POST['remarks'][$i].'","'.$_POST['company'][$i].'","'.$_POST['num'][$i].'","'.$_POST['price'][$i].'")';

    $db->exec($sqll);
	
}

unset($db);

header("Cache-Control: public");

header("Content-Description: File Transfer");

header('Content-disposition: attachment; filename='.basename($file)); //文件名

header("Content-Type: application/zip"); //zip格式的

header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件

header('Content-Length: '. filesize($file)); //告诉浏览器，文件大小

@readfile($file);

@unlink($file);//删除打包的临时zip文件。文件会在用户下载完成后被删除


//输出下载Word文档
//header("Location: ".$filename);