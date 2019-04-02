<?php
//把excel文件内容处理成我们想要的格式
include './PHPExcel/Classes/PHPExcel/IOFactory.php';

$info=$_GET['info'];

$filepath=$_GET['filepath'];

$inputFileName = $filepath;

date_default_timezone_set('PRC');

// 读取excel文件

try {
	
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
	
    $objPHPExcel = $objReader->load($inputFileName);
	
} catch(Exception $e) {
	
    die('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	
}

// 确定要读取的sheet，什么是sheet，看excel的右下角，真的不懂去百度吧
$sheet = $objPHPExcel->getSheet(0);

$highestRow = $sheet->getHighestRow();

$highestColumn = $sheet->getHighestColumn();

// 获取一行的数据

for ($row = 1; $row <= $highestRow; $row++){
	
// Read a row of data into an array
    $rowData[]= $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
}
//获取标题
$rowData['title'] = $rowData[0][0];

foreach ($rowData['title'] as $k=>$v){
//    echo "<pre>";
    $title[]=$v;
}

//获取字段名称

$title=$title[0];

//print_r($title);

$title=json_encode($title);

$rowData['field']=$rowData[1];

foreach ($rowData['field'] as $key=>$val){
	
    $field=$val;
	
}

$field=json_encode($field);

for($i=2;$i<count($rowData)-2;$i++){
	
foreach ($rowData[$i] as $ke=>$va){
	
   $arr[]=$va;
   
}

}

$arr=json_encode($arr);

header('Location:transaction.php?arr='.$arr.'&title='.$title.'&field='.$field.'&filepath='.$filepath.'&info='.$info);
?>