<?php 

require 'db.php';
require '../PHPExcel/PHPExcel.php';

$db = new db();
$sheet=0;
$file = $_FILES['file'];

function get_total_millisecond(){  
    $date = date('ymdHis',time());;
    $time = explode (" ", microtime () );   
    $time = 1000 + (int)($time [0] * 1000);
    $rand = rand(1001,9999);
    return ($date . $time . $rand); 
}

$excelname = get_total_millisecond();
$filePath='../lmzm_excel/'.$excelname.'.xls';
move_uploaded_file($file['tmp_name'],$filePath);

if(empty($filePath) or !file_exists($filePath)){
    echo false;
    die;
}
$PHPReader = new PHPExcel_Reader_Excel2007();        //建立reader对象
if(!$PHPReader->canRead($filePath)){
        $PHPReader = new PHPExcel_Reader_Excel5();
        if(!$PHPReader->canRead($filePath)){
                echo 'no Excel';
                return ;
        }
}
$PHPExcel = $PHPReader->load($filePath);        //建立excel对象
$currentSheet = $PHPExcel->getSheet($sheet);        //**读取excel文件中的指定工作表*/
$allColumn = $currentSheet->getHighestColumn();        //**取得最大的列号*/
$allRow = $currentSheet->getHighestRow();        //**取得一共有多少行*/
$data = array();
for($rowIndex=1;$rowIndex<=$allRow;$rowIndex++){        //循环读取每个单元格的内容。注意行从1开始，列从A开始
        for($colIndex='A';$colIndex<='L';$colIndex++){
                $addr = $colIndex.$rowIndex;
                $cell = $currentSheet->getCell($addr)->getValue();
                if($cell instanceof PHPExcel_RichText){ //富文本转换字符串
                        $cell = $cell->__toString();
                }
                $data[$rowIndex][$colIndex] = $cell;
        }
}
$order = ['A','B','C','D','E','F','G','H','I','J'];
$attribute = ['lmzm_user_id','tree_name','trunk_diameter','ground_diameter','crown','plant_height','branch_point_height','ball','count','price'];
$datas = array();
$n = 0;
for ($i=2; $i <= count($data); $i++) { 
    $onedata = $data[$i];
    foreach ($onedata as $key => $value) {
        if($value){
            for ($j=0; $j < count($order); $j++) { 
                if($key == $order[$j]){
                    $datas[$n][$attribute[$j]] = $value;
                }
            }
        }
    }
    ++$n; 
}
$dictionary = $db->query('select * from dictionary_attribute order by CONVERT(name USING gbk)');
$n = count($dictionary);
if($datas){
    for ($i=0; $i < count($datas); $i++) { 
        $keydatas = array();
        $nkeydatas = array();
        $valuedatas = array();
        foreach ($datas[$i] as $key => $value) {
                if($key == 'tree_name'){
                    $has = false;
                    for ($j=0; $j < $n; $j++) { 
                        if($dictionary[$j]['name'] == $value){
                            array_push($keydatas, 'type');
                            array_push($nkeydatas, '?');
                            array_push($valuedatas, $dictionary[$j]['type']);
                            $has = true;
                        }
                    }
                    if(!$has){
                        array_push($keydatas, 'type');
                        array_push($nkeydatas, '?');
                        array_push($valuedatas, 11);
                    }
                }
                array_push($keydatas, $key);
                array_push($nkeydatas, '?');
                array_push($valuedatas, $value);
            
        }
        $sql = 'insert into lmzm_trees('.join(',',$keydatas).') values('.join(',',$nkeydatas).')';
        $result = $db->prepare_insert($sql,$valuedatas);
    }
}
unset($db);
echo $result;
