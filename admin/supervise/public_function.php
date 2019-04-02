<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-12-05 09:45:04
 * @Last Modified by: mikey.zhaopeng
 * @Last Modified time: 2019-03-15 13:45:06
 */

/**
 * 数据统一返回
 * @param  integer $code [description]
 * @param  string  $msg  [description]
 * @param  array   $data [description]
 * @return [type]        [description]
 */
function _res($status = 0, $msg = '', $data = [])
{

    $content = [

        'status' => $status,

        'count' => isset($data['count'])?$data['count']:0,

        'msg' => $msg,

        'total'=>isset($data['total'])?$data['total']:0, //数据总数

        'total_page' =>isset($data['total_page'])?$data['total_page']:1,  //总页数

        'page'=>isset($data['page'])?$data['page']:1,

        'data' =>isset($data['data'])?$data['data']:[]

    ];

    exit(json_encode($content,JSON_UNESCAPED_UNICODE));
}

/**
 * 跨域请求
 */
function Access_Header(){
    session_start();
    header('Content-type: text/html;charset=utf-8');
    if($_SERVER['HTTP_HOST']=="test.cnzhaoshu.com"){
        header('Access-Control-Allow-Origin:*');
    }
}
/**
 * 验证手机格式
 * @param  [type]  $tel [description]
 * @return boolean      [description]
 */
function isPhone($tel)
    {
        $isMob="/^1[3-5,7-8]{1}[0-9]{9}$/";
        $isTel="/^([0-9]{3,4}-)?[0-9]{7,8}$/";
        return preg_match($isMob,$tel) || preg_match($isTel,$tel);
    }
/**
 *  判断唯一性
 * @param  string $tablename 表名
 * @param  string $field     需要查找的字段
 * @param  string $value     值
 * @return [type]
 */
function checkUnique($tablename,$field,$value){
    $db= new  db();
    $sql1="select $field from $tablename where $field = '".$value."'";
    $res=$db->query($sql1);
    if($res){
        return true; //存在
    }else{
        return false;//不存在
    }
    unset($db);
}
/**
 * 检查是否已经提交过异常苗木审核
 * @param  string $userid 管理员id
 * @param  string $id     苗木id
 * @return
 */
function checkstate($userid="",$id=""){
    $db = new db();

    $sql = "select userid,content,state from maps_unusual where maps_order_id='".$id."'";

    $result = $db->query($sql)[0];

    unset($db);
    // 别的管理员已经审核
    if($result['state'] == '1' && !empty($result['content']) && $result['userid'] != $userid){

        $data['status'] = 1;

        $data['msg']    = '其他管理员已经提交审核信息';

        echo json_encode($data);

        exit;
    // 没有审核
    }elseif($result['state'] == '2' && empty($result['content']) && empty($result['userid'])){

        return true;
    //自已已经审核过
    }elseif($result['state'] == '1' && !empty($result['content']) && $result['userid'] == $userid){

        $data['status'] = 1;

        $data['msg']    = '你已经提交过审核信息，请勿重复提交';

        echo json_encode($data);

        exit;

    }

}


/**
 * 数组中为NULL转换为 字符串 ''
 * @param   $arr 将要处理的数组
 * @return
 */
function _unsetNull($arr){

    if($arr !== null){

        if(is_array($arr)){

            if(!empty($arr)){

                foreach($arr as $key => $value){

                    if($value === null){

                        $arr[$key] = '';

                    }else{

                        $arr[$key] = _unsetNull($value);      //递归再去执行

                    }
                }

            }else{

                $arr = '';

            }

        }else{

            if($arr === null){ $arr = ''; }         //注意三个等号

        }

    }else{

        $arr = '';

    }

    return $arr;
}

/**
 * 检查二维码是否已经二次绑定过
 * @param  string $qrcode 二维码编号
 * @return
 */
function check_qrcode($qrcode){

    $dbclass = new db();

    $sql = "select binding_status from maps_order where id =".$qrcode;

    $result = $dbclass->query($sql)[0]['binding_status'];

    unset($dbclass);

    if($result == 1){

        return 1;

    }else{

        return 2;

    }

}
/**
 * 检查是否已经生成合同
 * @param  [type] $tender_order_id [description]
 * @return [type]         [description]
 */
function check_contract($tender_order_id){

    $db = new db();

    $sql1="select a.project,b.project_id  from tender_order a left join contract b on a.tender_order_id = b.tender_order_id where a.tender_order_id = '".$tender_order_id."'";

    $project_id =$db->query($sql1)[0];

    unset($db);

    if(empty($project_id['project_id'])){

        return array('status' => 0, 'project_id'=>$project_id['project']);

    }else{

        return array('status' => 1, 'project_id'=>$project_id['project_id']);

    }

}

/**
 * 写一个函数 用来生产多条数据的单句sql
 * @param  string $table  表名
 * @param  Array $data   添加的数据
 * @param  Array $fields 添加的字段
 * @return string      sql语句
 */
function warpSqlByData($table,$data,$fields)
{

    $sql = "INSERT INTO ".$table;

    $col_list ='';

    $value_list ='';

    $fields = array_map('formatclos',$fields);
    // 判断$fields是否是一个数组
    if(is_array($fields))
    {

        $col_list = implode(',',$fields);

    }
    //组织列
    $cols = '('.$col_list.')';

    $sql = $sql.$cols;
    //再来组织value部分
    foreach ($data as $value)
    {
        //判断列的值 进行转化
        $value = array_map('formatvalues',$value);

        $value_part = implode(',',$value);

        $value_list .= '('.$value_part.'),';

    }

    $value_list = rtrim($value_list,',');

    $value_list = ' VALUES'.$value_list;

    $sql = $sql.$value_list;

    return $sql;
}

//格式化列名
function formatclos($col)
{

    return sprintf("`$col`");

}

//格式化列名
function formatvalues($val)
{

    return sprintf("'$val'");

}


/**
 * 发送异常苗木通知
 * @param  string $touser   需要发送用户的WeChatid
 * @param  string $url      跳转地址
 * @param  string $first    标题
 * @param  string $keyword1 关键字
 * @param  string $keyword2 异常类型
 * @param  string $keyword3 异常方法
 * @param  string $keyword4 发生时间
 * @param  string $keyword5 异常信息
 * @param  string $remark   备注
 * @return
 */
function send_message_unusual($touser="",$first="",$keyword1="",$keyword2="",$keyword3="",$keyword4="",$keyword5="",$remark="",$url=''){
    include_once "../../wechat/wechat.class.php";

    $data = array( 'touser' => $touser,
        'template_id' => 'Ye-S5fgn2woq-iBat_9btaLN_NPOSDGzIDCPHvzD6f8',
        'url' => $url,
        'data'=>array(
            'first'=>array(
                'value' => $first
            ),
            'keyword1' => array(
                'value' => $keyword1
            ),
            'keyword2' => array(
                'value' => $keyword2
            ),
            'keyword3' => array(
                'value' => $keyword3
            ),
            'keyword4' => array(
                'value' => $keyword4
            ),
            'keyword5' => array(
                'value' => $keyword5
            ),
            'remark'=>array(
                'value'=> $remark
            )
        )
    );
    // var_dump($data);
    // die;
    $weObj = new Wechat();

    $weObj->sendTemplateMessage($data);

    unset($weObj);
}


/**
 * 数据导出表格
 * @param  array  $title    A2:Z2 显示的文字
 * @param  array  $data     需要导出的数据
 * @param  string $fileName 文件的名字
 * @param  string $savePath 保存的路径
 * @return string     excel文件的路径
 */
function get_tree_excel($title=array(), $data=array(), $fileName='', $savePath='../upload/xlsx/'){
    require '../PHPExcel/Classes/PHPExcel.php';
     $obj = new PHPExcel();
    //横向单元格标识
    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

    $obj->getActiveSheet(0)->setTitle('sheet1');   //设置sheet名称

    $_row = 2;   //设置纵向单元格标识

    if($title){

        $_cnt = count($title);

        $obj->getActiveSheet(0)->mergeCells('A1:'.$cellName[$_cnt-1].$_row);   //合并单元格
        //设置合并后的单元格内容

        $obj->setActiveSheetIndex(0)->setCellValue('A1', '树木导出，导出时间：'.date('Y-m-d H:i:s'))->getStyle('A1')->getFont()->setSize(24);
        // 设置样式
        $obj->getActiveSheet()->getStyle('A:J')->getFont()->setBold(true);
        $obj->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
        $obj->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $obj->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $obj->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $obj->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $obj->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $obj->getActiveSheet()->getColumnDimension('G')->setWidth(50);
        $obj->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $obj->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $obj->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        // 居中
        $obj->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $obj->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $obj->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $obj->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $obj->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $obj->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $obj->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $obj->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $obj->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $obj->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $_row++;

        $i = 0;

        foreach($title AS $v){   //设置列标题

            $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);

            $i++;

        }

        $_row++;

    }



    //填写数据

    if($data){

        $i = 0;

        foreach($data AS $_v){

            $j = 0;

            foreach($_v AS $_cell){

                $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell);

                $j++;

            }

            $i++;

        }

    }



    //文件名处理

    if(!$fileName){

        $fileName = uniqid(time(),true);

    }

    $objWrite = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');

    $_fileName = iconv("utf-8", "gb2312", $fileName);   //转码

    $_savePath = $savePath.$_fileName.'.xlsx';

    $objWrite->save($_savePath);

    unset($obj);

    unset($objWrite);

    return  $savePath.$fileName.'.xlsx';
}

/**
 * 得到文件扩展名
 * @param  [type] $filename 文件
 * @return [type]
 */
function getExt($filename){
    return strtolower(pathinfo($filename,PATHINFO_EXTENSION));
}

/**
 * 产生唯一字符串
 * @return [type] [description]
 */
function getUniName(){
    return md5(uniqid(microtime(true),true));
}

/**
 * 图片上传方法
 * @param  [type]  $fileInfo 文件
 * @param  string  $path     保存的路径
 * @param  integer $maxSize  设置文件最大像素
 * @param  boolean $flag     是否检测图片是否是真实的图片类型
 * @param  array   $allowExt 支持传输的图片类型
 * @return [type]            返回文件路径
 */
function uploadFile($fileInfo,$path="../upload/maps",$maxSize=5097152,$allowExt=array("jpeg","jpg","png","gif","blob"),$flag=false){

    if($fileInfo['error']==UPLOAD_ERR_OK){
       //检测上传文件大小
       if($fileInfo['size']>$maxSize){
           $res['mes']='上传文件过大';
       }
       //检测上传文件的文件类型
       if($fileInfo['name'] == "blob"){
            $ext = "jpg";
       }else{
            $ext=getExt($fileInfo['name']);//得到上传文件的后缀
       }

       if(!in_array($ext,$allowExt)){
           $res['res']='非法文件类型';
       }
       if($flag){
           if(!getimagesize($fileInfo['tmp_name'])){
               $res['mes']='不是真实的图片类型';
           }
       }
       //检测文件是否是通过HTTP POST上传上来的
       if(!is_uploaded_file($fileInfo['tmp_name'])){
           $res['mes']='文件不是通过HTTP POST方式上传上来的';
       }
       if(isset($res)) return $res;
       // 判断有没有路径
       if(!file_exists($path)){
           mkdir($path,0777,true);
           chmod($path,0777);
       }
       // 获取唯一文件名
       $uniName=getUniName();
       // 拼接移动的路径
       $destination=$path.'/'.$uniName.'.'.$ext;
       
       if(!move_uploaded_file($fileInfo['tmp_name'],$destination)){
           
           $res['mes']=$fileInfo['name'].'文件移动失败';
       }else{
            $res['mes']=$fileInfo['name'].'上传成功';
            $res['dest']='/admin/upload/maps/'.$uniName.'.'.$ext;
       }
        return $res;
    }else{
        switch($fileInfo['error']){
            case 1:
                 $res['mes']="上传文件超出了php配置中upload_max_filesize选项的值";
                break;
            case 2:
                 $res['mes']="超出了表单MAX_FILE_SIZE限制的大小";
                break;
            case 3:
                 $res['mes']="文件部分被上传";
                break;
            case 4:
                 $res['mes']="没有选择上传文件";
                break;
            case 6:
                 $res['mes']="没找到临时目录";
                break;
            case 7:
                 $res['mes']="";
                break;
            case 8:
                 $res['mes']="系统错误";
                break;
        }
        return $res;
    }
}

/**
 * 获取IP地址
 * @return [type] [description]
 */
function getIp(){
           if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
               $ip = getenv("HTTP_CLIENT_IP");
           else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
               $ip = getenv("HTTP_X_FORWARDED_FOR");
          else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
               $ip = getenv("REMOTE_ADDR");
          else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                   $ip = $_SERVER['REMOTE_ADDR'];
               else
                   $ip = "unknown";
               return($ip);
    }
