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
for($rowIndex=2;$rowIndex<=$allRow;$rowIndex++){        //循环读取每个单元格的内容。注意行从1开始，列从A开始
    $colIndex = 'A';
    for ($i = 1; $i <= 8; $i++) {
        $addr = $colIndex.$rowIndex;
        $cell = $currentSheet->getCell($addr)->getValue();
        if($cell instanceof PHPExcel_RichText){ //富文本转换字符串
                $cell = $cell->__toString();
        }
        $data[$rowIndex][$colIndex] = $cell;
        $colIndex++;
    }
}

$b = count($data)+1;

for ($i=2; $i <= $b; $i++) { 
    $onedata = $data[$i];
    $keyarray = array();
    $valuearray = array();
    $varray = array();
    foreach ($onedata as $key => $value) {
        switch ($key) {
            case 'A':
                array_push($keyarray, 'name');
                array_push($valuearray, $value);
                array_push($varray, '?');
                break;
            case 'B':
                array_push($keyarray, 'gname');
                if($value){
                    array_push($valuearray, $value);
                }else{
                    array_push($valuearray, $onedata['A']);
                }
                array_push($varray, '?');
                break;
            case 'C':
                array_push($keyarray, 'type');
                array_push($valuearray, $value ? $value : '暂无');
                array_push($varray, '?');
                break;
            case 'D':
                array_push($keyarray, 'isplant');
                array_push($valuearray, ($value == '是') ? 1 : 0);
                array_push($varray, '?');
                break;
            case 'E':
                array_push($keyarray, 'pingyuan');
                array_push($valuearray, $value ? 1 : 0);
                array_push($varray, '?');
                break;
            case 'F':
                array_push($keyarray, 'qianshan');
                array_push($valuearray, $value ? 1 : 0);
                array_push($varray, '?');
                break;
            case 'G':
                array_push($keyarray, 'lengliang');
                array_push($valuearray, $value ? 1 : 0);
                array_push($varray, '?');
                break;
            case 'H':
                array_push($keyarray, 'tongyong');
                array_push($valuearray, $value ? 1 : 0);
                array_push($varray, '?');
                break;
        }
    }

    $sql = 'insert into lmzm_dictionary('.join(',',$keyarray).') values('.join(',',$varray).')';
    $result = $db->prepare_insert($sql,$valuearray);    
}

unset($db);
echo $result;




