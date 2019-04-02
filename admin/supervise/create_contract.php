<?php
/**
 * @Author: Lizhongyang
 * @Date:   2018-11-20 10:35:29
 * 调取甲乙方信息，生成合同
 * @
 */
require "../../com/db.php";
include "./public_function.php";
include "./Loginterface.php";
Access_Header(); // header头信息

$db= new db();
//开启日志
Loginterface::start( 'create-contract' );

$tender_order_id = isset($_GET['tender_order_id'])?$_GET['tender_order_id']:"";
// 根据投标的订单id 查找招标的项目id和userID
$sql1="select project,tender_user_id from tender_order where tender_order_id = '".$tender_order_id."' and provider_status = 1";

$data1=$db->query($sql1);
// 根据招标的项目id和userID 查找投标的树id和项目id
$sql="select project,tender_tree_id from tender_order where tender_user_id = '".$data1[0]['tender_user_id']."' and project='".$data1[0]['project']."' and provider_status = 1";

$data=$db->query($sql);
//把树ID转换成字符串
foreach ($data as $key => $val) {

    $newdata[]= $val['tender_tree_id'];

}

$newdata = implode(',',$newdata);
//写入日志
$requestData = '生成合同时间：'.date('Y-m-d H:i:s').'  所有树ID：'.json_encode($newdata);

Loginterface::add( $requestData);
//查找供应商在该项目下投的所有树的信息
$sql="select
a.tree_seq_num,a.tree_name,a.plant_height,a.dbh,a.ground_diameter,a.crown,a.remarks,a.company,b.tree_num,a.price
from
new_tree_order a left join tender_order b on a.project = b.project
WHERE
b.tender_user_id = '".$data1[0]['tender_user_id']."' and a.tree_order_id IN ('".$newdata."')";

$tree_data=$db->query($sql);
//写入日志
$requestData = '发生时间：'.date('Y-m-d H:i:s').'  供应商在该项目下投的所有树的信息：'.json_encode($tree_data);

Loginterface::add( $requestData);
// 设置表头
$title = array('序号','名称','株高','胸径','地径','冠幅','备注','单位','数量','价格');
// 生成表格，返回Excel表格路径
$query_file_path = get_tree_excel($title,$tree_data,'excel'.time());
//写入日志
$requestData = '生成Excel时间：'.date('Y-m-d H:i:s').'  Excel路径：'.json_encode($query_file_path);

Loginterface::add( $requestData);
// 生成合同，如果没有乙方信息返回并且提示完善信息，如果有，直接打包下载个人合同和Excel表格
create_contract($data[0]['project'],$query_file_path,$tree_data,$tender_order_id);
// 删除数据库连接
unset($db);
/**
 * 生成合同并且打包下载
 * @param  string $project_id      项目id
 * @param  string $query_file_path Excel表格路径
 * @param  [type] $order_project   招标信息
 * @param  string $tender_order_id 订单id
 * @return [type]
 */
function create_contract($project_id="",$query_file_path="",$order_project,$tender_order_id=""){
    require "../word/PHPWord.php";
    $PHPWord = new PHPWord();
    $dbclass= new db();
    // 查找当前项目信息
    $sql="select * from order_project where project_id='".$project_id."'";
    $res=$dbclass->query($sql)[0];
    // 获取甲方公司名称
    $party_A=isset($res['partya_company_name'])?$res['partya_company_name']:"";
    //获取甲方数据
    $party_A_info="select company_name,representative,open_bank,bank_num,duty_paragraph,address,contacts,tel from contract_info where `company_name`='".$party_A."'";

    $partya_info=$dbclass->query($party_A_info)[0];
    //获取乙方信息
    $party_B_info="select b.company_name,b.representative,b.open_bank,b.bank_num,b.duty_paragraph,b.address,b.contacts,b.tel from tender_order a left join contract_info b on a.tender_user_id = b.userid where a.project = '".$project_id."' and a.tender_order_id = '".$tender_order_id."'";
    $partyb_info=$dbclass->query($party_B_info)[0];
    //获取签约时间
    $contract_time=isset($res['create_time'])?$res['create_time']:"";
    $sign_time=explode('-',$contract_time);
    $sing_year=$sign_time[0];
    $sing_month=$sign_time[1];
    $sing_day=substr($sign_time[2],0,2);
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
    //加载页面模板
    $document = $PHPWord->loadTemplate('../word/contract_all.docx');
    //三方信息
    $document->setValue('c_price',$c_price);
    $document->setValue('ring_price',$ring_price);
    $document->setValue('ring_num',$ring_num);
    //铺设采购时间
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
    $document->setValue('tree_name',iconv('utf-8', 'GB2312//IGNORE', $order_project[0]['tree_name']));
    $document->setValue('dbh',$order_project[0]['dbh']);
    $document->setValue('crown',$order_project[0]['crown']);
    $document->setValue('plant_height',$order_project[0]['plant_height']);
    $document->setValue('num',$order_project[0]['tree_num']);
    $document->setValue('company',iconv('utf-8', 'GB2312//IGNORE', $order_project[0]['company']));
    $document->setValue('price',$order_project[0]['price']);
    $document->setValue('remarks',iconv('utf-8', 'GB2312//IGNORE',$order_project[0]['remarks']));
    //铺设甲方数据
    $document->setValue('party_A',iconv('utf-8', 'GB2312//IGNORE', $partya_info['company_name']));
    $document->setValue('A_legal_person',iconv('utf-8', 'GB2312//IGNORE', $partya_info['representative']));
    $document->setValue('A_open_bank',iconv('utf-8', 'GB2312//IGNORE', $partya_info['open_bank']));
    $document->setValue('A_bank_num',$partya_info['bank_num']);
    $document->setValue('A_paragraph',$partya_info['duty_paragraph']);
    $document->setValue('A_address',iconv('utf-8', 'GB2312//IGNORE', $partya_info['address']));
    $document->setValue('A_contacts',iconv('utf-8', 'GB2312//IGNORE', $partya_info['contacts']));
    //  $document->setValue('A_contacts',"");
    $document->setValue('A_phone',$partya_info['tel']);
    //铺设乙方数据
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

        $document->setValue('b_phone',$partyb_info['tel']);
        //合同填充
        $document->setValue('ccc',"");
    }
    // 设置合同保存路径
    $docxfilename = '../word/test/world'.time().'.docx';
    //写入日志
    $requestData = '生成Word时间：'.date('Y-m-d H:i:s').'  Word路径：'.json_encode($docxfilename);

    Loginterface::add( $requestData);

    $document->save($docxfilename);
    // 设置压缩包名称
    $contract_number=time();
    // 设置zip包保存路径
    $file = '../upload/zip/'.$contract_number.".zip";

    // 判断如果没有压缩包，创建压缩包并且把合同和Excel打包
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
    // 检查zip包是否保存
    if(!file_exists($file)){
        //写入日志
        $requestData = '发生时间：'.date('Y-m-d H:i:s').'  备注：'.json_encode(array('status' => 1,'msg'=>'生成zip包错误'));

        Loginterface::add( $requestData);

        Loginterface::end();

        _res(1,'系统出现错误，请重试或者联系管理员');

    }
    //写入日志
    $requestData = '生成zip包时间：'.date('Y-m-d H:i:s').'  zip路径：'.json_encode($file);

    Loginterface::add( $requestData);
    // 合同编号
    $number=date("YmdHis",time());
    //查看是否已经生成合同
    $check_sql = "select
b.contract_new_id,b.order_path,b.contract_path,b.tarfile_path
from tender_order a
right join contract b on  a.tender_order_id = b.tender_order_id
where tender_user_id = ( select tender_user_id FROM tender_order WHERE tender_order_id = '".$tender_order_id."' ) and project = '".$project_id."'";

    $contract = $dbclass->query($check_sql)[0];
    // 如果已经生成合同，就修改掉之前的合同，反之则添加
    if($contract){

        $contract_sql = "update contract set order_path='".$query_file_path."',contract_path='".$docxfilename."',tarfile_path='".$file."',order_num='".$number."' where contract_new_id ='".$contract['contract_new_id']."'";
        $read = $dbclass->exec($contract_sql);

        // 删除对应的路径文件
        @unlink($contract['order_path']);
        @unlink($contract['contract_path']);
        @unlink($contract['tarfile_path']);
    }else{
        $contract_sql = "insert into contract(project_id,tender_order_id,order_path,contract_path,tarfile_path,order_num) values('".$project_id."','".$tender_order_id."','".$query_file_path."','".$docxfilename."','".$file."','".$number."')";
        $read = $dbclass->insert($contract_sql);
    }
    // 清除实例化
    unset($PHPWord);
    unset($zip);
    unset($dbclass);

    if($read){
        // 声明格式并下载压缩包
        header("Content-type: application/octet-stream" );
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header('Content-disposition: attachment; filename='.basename($file)); //文件名
        header("Content-Type: application/zip"); //zip格式的
        header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件
        header('Content-Length: '. filesize($file)); //告诉浏览器，文件大小
        //写入日志
        $requestData = '发生时间：'.date('Y-m-d H:i:s').'  备注：'.json_encode(array('status' => 1,'msg'=>'下载合同成功'));

        Loginterface::add( $requestData);

        Loginterface::end();

        @readfile($file);
        @unlink($file);//删除打包的临时zip文件。文件会在用户下载完成后被删除
    }else{
        //写入日志
        $requestData = '发生时间：'.date('Y-m-d H:i:s').'  备注：'.json_encode(array('status' => 1,'msg'=>'数据保存失败'));

        Loginterface::add( $requestData);

        Loginterface::end();

        _res(1,'保存失败');
    }


}

