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
    $colIndex = 'A';
    for ($i = 1; $i <= 3; $i++) {
        $addr = $colIndex.$rowIndex;
        $cell = $currentSheet->getCell($addr)->getValue();
        if($cell instanceof PHPExcel_RichText){ //富文本转换字符串
                $cell = $cell->__toString();
        }
        $data[$rowIndex][$colIndex] = $cell;
        $colIndex++;
    }
}

$b = count($data);


for ($i=2; $i <= $b; $i++) { 
    $onedata = $data[$i];

    $sql = 'update lmzm_tree set aliases_name=? , type=? where tree_name=?';
    $result = $db->prepare_exec($sql,array($onedata['B'],$onedata['C'],$onedata['A']));

}

unset($db);
echo $result;




