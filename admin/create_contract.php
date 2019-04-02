<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/8/14
 * Time: 15:39
 */
//var_dump($_POST);die
//var_dump($order_project);die;
session_start();
$project_id=$_GET['project_id'];
//var_dump($_POST);
//var_dump($_GET);die;
// var_dump($project_id);die;
create_contract($project_id);
function create_contract($project_id=""){

    $order_project=$_SESSION['order_project'];
//    var_dump($order_project);die;
    $query_file_path=$_SESSION['query_file_path'];
//    var_dump($query_file_path);die;
    require_once "./word/PHPWord.php";
    require "../com/db.php";
    $PHPWord=new PHPWord();
    $dbclass= new db();

    $sql="select * from order_project where project_id=".$project_id;

    $res=$dbclass->query($sql)[0];

    $party_A=isset($res['partya_company_name'])?$res['partya_company_name']:"";

    $party_B=isset($res['partyb_company_name'])?$res['partyb_company_name']:"";
    //获取签约时间
    $contract_time=isset($res['signing_time'])?$res['signing_time']:"";

    if($contract_time!=""){

        $sign_time=explode('-',$contract_time);

        $sing_year=$sign_time[0];

        $sing_month=$sign_time[1];

        $sing_day=substr($sign_time[2],0,2);

    }else{

        $sing_year="";

        $sing_month="";

        $sing_day="";

    }
    //获取开始采购时间
    $b_time=isset($res['begin_time'])?$res['begin_time']:"";
    $b_time=explode('-',$b_time);
    $b_time_year=$b_time[0];
    $b_time_month=$b_time[1];
    $b_time_day=substr($b_time[2],0,2);
    $s_time=isset($res['end_time'])?$res['end_time']:"";
    $s_time=explode('-',$s_time);
    $s_time_year=$s_time[0];
    $s_time_month=$s_time[1];
    $s_time_day=substr($s_time[2],0,2);

    //添加树环数量
    $c_price=isset($res['third_party_receivables'])?$res['third_party_receivables']:"";
    $ring_price=isset($res['ring_price'])?$res['ring_price']:"";
    $ring_num=isset($res['ring_num'])?$res['ring_num']:"";
//    //加载页面模板
//
    $document = $PHPWord->loadTemplate('./word/contract_all.docx');
//    //三方信息
    $document->setValue('c_price',$c_price);
    $document->setValue('ring_price',$ring_price);
    $document->setValue('ring_num',$ring_num);
//    //铺设采购时间
    $document->setValue('b_time_year',$b_time_year);
    $document->setValue('b_time_month',$b_time_month);
    $document->setValue('b_time_day',$b_time_day);
    $document->setValue('s_time_year',$s_time_year);
    $document->setValue('s_time_month',$s_time_month);
    $document->setValue('s_time_day',$s_time_day);
    $document->setValue('sign_year',$sing_year);
    $document->setValue('sign_month',$sing_month);
    $document->setValue('sign_day',$sing_day);
    //铺设采购单数据
    $document->setValue('number',1);
    $document->setValue('tree_name',iconv('utf-8', 'GB2312//IGNORE', $order_project['tree_name']['0']));
    $document->setValue('dbh',$order_project['dbh']['0']);
    $document->setValue('crown',$order_project['crown']['0']);
    $document->setValue('plant_height',$order_project['plant_height']['0']);
    $document->setValue('num',$order_project['tree_num']['0']);
    $document->setValue('company',iconv('utf-8', 'GB2312//IGNORE', $order_project['company']['0']));
    $document->setValue('price',$order_project['price']['0']);
    $document->setValue('remarks',iconv('utf-8', 'GB2312//IGNORE',$order_project['remarks']['0']));
    //铺设甲双方数据
    $party_A_info="select * from contract_info where `company_name`='".$party_A."'";
    $partya_info=$dbclass->query($party_A_info);
//    var_dump($partya_info);die;
    $partya_info=$partya_info['0'];
    $document->setValue('party_A',iconv('utf-8', 'GB2312//IGNORE', $partya_info['company_name']));
    $document->setValue('A_legal_person',iconv('utf-8', 'GB2312//IGNORE', $partya_info['representative']));
    $document->setValue('A_open_bank',iconv('utf-8', 'GB2312//IGNORE', $partya_info['open_bank']));
    $document->setValue('A_bank_num',$partya_info['bank_num']);
    $document->setValue('A_paragraph',$partya_info['duty_paragraph']);
    $document->setValue('A_address',iconv('utf-8', 'GB2312//IGNORE', $partya_info['address']));
    $document->setValue('A_contacts',iconv('utf-8', 'GB2312//IGNORE', $partya_info['contacts']));
//    $document->setValue('A_contacts',"");

    $document->setValue('A_phone',$partya_info['tel']);
//    //铺设乙方数据
    $party_B_info="select * from contract_info where `company_name`='".$party_B."'";
    $partyb_info=$dbclass->query($party_B_info);
    $partyb_info=$partyb_info['0'];
//    var_dump($party_B_info['bank_num']);die;
//    var_dump($res['project_name']);die;
    $document->setValue('project',iconv('utf-8', 'GB2312//IGNORE', $res['project_name']));
    if(empty($partyb_info)){
        $document->setValue('party_B',"");
        $document->setValue('B_legal_person',"");
        $document->setValue('B_open_bank',"");
        $document->setValue('B_bank_num',"");
        $document->setValue('B_paragraph',"");
        $document->setValue('B_address',"");
        $document->setValue('b_phone',"");
        $document->setValue('B_contacts',"");
        //合同填充
        $document->setValue('ccc',"");
    }else{
        $document->setValue('party_B',iconv('utf-8', 'GB2312//IGNORE', $partyb_info['company_name']));
        $document->setValue('B_legal_person',iconv('utf-8', 'GB2312//IGNORE', $partyb_info['representative']));
        $document->setValue('B_open_bank',iconv('utf-8', 'GB2312//IGNORE', $partyb_info['open_bank']));
        $document->setValue('B_bank_num',$partyb_info['bank_num']);
        $document->setValue('B_paragraph',$partyb_info['duty_paragraph']);
        $document->setValue('B_address',iconv('utf-8', 'GB2312//IGNORE', $partyb_info['address']));
        $document->setValue('B_contacts',iconv('utf-8', 'GB2312//IGNORE', $partyb_info['contacts']));
//        $document->setValue('B_contacts',"");

        $document->setValue('b_phone',$partyb_info['tel']);
        //合同填充
        $document->setValue('ccc',"");
    }

    $docxfilename = './word/test/world'.time().'.docx';
//    var_dump(111);die;
   $document->save($docxfilename);
//    var_dump($cccee);die;
    $contract_number=time();
    $file = $contract_number.".zip";
    $datalist=array($docxfilename,$query_file_path);
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
    if(!file_exists($file)){
        exit("无法找到文件");
    }
    $contract_sql=" update order_project set order_path='".$query_file_path."' ,contract_path='".$docxfilename."',tarfile_path='".$file."' where project_id=$project_id";
//    var_dump($contract_sql);die;
    $dbclass->exec($contract_sql);
    unset($dbclass);
//    unset($_SESSION['query_file_path']);
//    unset($_SESSION['order_project']);
    //var_dump($res);die;
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header('Content-disposition: attachment; filename='.basename($file)); //文件名
    header("Content-Type: application/zip"); //zip格式的
    header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件
    header('Content-Length: '. filesize($file)); //告诉浏览器，文件大小
    @readfile($file);
    @unlink($file);//删除打包的临时zip文件。文件会在用户下载完成后被删除

}