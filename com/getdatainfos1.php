<?php
header("Content-Type: text/html; charset=UTF-8");
require 'db.php';
require '../PHPExcel/PHPExcel.php';
$db = new db();
$data = json_decode($_GET['data'],true);

$st = '';
$array = array();

$apparea = $data['apparea'];
for ($i=0; $i < count($apparea); $i++) { 
	$st .= ' and '.$apparea[$i].'=1';
}
unset($data['apparea']);  

$type = $data['type'];
if($type){$st .= ' and type=?';array_push($array, $type);}
unset($data['type']);  

$name = $data['name'];
if($name){$st .= ' and aliases_name=?';array_push($array, $name);}
unset($data['name']);

if($st){
	$st = ltrim($st,' and ');
	$st = ' where '.$st;
}

$str = '';
$newarray = array();
foreach ($data as $key => $value) {
	if($value){
		$k = substr($key, 0,(strlen($key)-1));
		$a = substr($value, 0,2);
		$b = substr($value, 0,1);
		if($a === '<='){
			$a = ltrim($value,'<=');
			if(is_numeric($a)){
				$str .= ' and '.$k.' <= ?';
				array_push($newarray, $a);
			}
		}elseif($a === '>='){
			$a = ltrim($value,'>=');
			if(is_numeric($a)){
				$str .= ' and '.$k.' >= ?';
				array_push($newarray, $a);
			}
		}elseif($b === '>'){
			$b = ltrim($value,'>');
			if(is_numeric($b)){
				$str .= ' and '.$k.' > ?';
				array_push($newarray, $b);
			}
		}elseif($b === '<'){
			$b = ltrim($value,'<');
			if(is_numeric($b)){
				$str .= ' and '.$k.' < ?';
				array_push($newarray, $b);
			}
		}else{
			if(is_numeric($value)){
				$str .= ' and '.$k.' = ?';
				array_push($newarray, $value);
			}
		}
	}
}

// if(!$str) exit;


$sql = 'select distinct(aliases_name) a,sum(count) b from lmzm_tree'.$st.' group by a order by b desc';
$result = $db->prepare_query($sql,$array);

$n = count($result);
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$activeSheet = $objPHPExcel-> getActiveSheet();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
$activeSheet->getDefaultStyle()->getFont()->setSize(10);
//设置默认行高
$activeSheet->getDefaultRowDimension()->setRowHeight(20);
$activeSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


// 设置宽度
$activeSheet->getColumnDimension('A')->setWidth(15);
$activeSheet->getColumnDimension('B')->setWidth(30);
$activeSheet->getColumnDimension('C')->setWidth(30);
// 居中 左偏 右偏
$activeSheet->getStyle('A:C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$activeSheet->setCellValue('A1', '序号');
$activeSheet->setCellValue('B1', '树种');
$activeSheet->setCellValue('C1', '数量');

if($st){
	$thisrows = 2;
	for ($i=0; $i < $n; $i++) {
		$a = $result[$i];
		$name = $a['a'];
		$sql = 'select sum(count) a from lmzm_tree where aliases_name=?'.$str;
		$dataarr = $newarray;
		array_unshift($dataarr,$name);
		$result1 = $db->prepare_query($sql,$dataarr);
		if($result1[0]['a']){
			$activeSheet->setCellValue('A'.$thisrows, ($thisrows-1));
			$activeSheet->setCellValue('B'.$thisrows, $a['a']);
			$activeSheet->setCellValue('C'.$thisrows, $result1[0]['a']);
			$thisrows++;
		}
	}
}else{
	$thisrows = 2;
	for ($i=0; $i < $n; $i++) {
		$a = $result[$i];
		$activeSheet->setCellValue('A'.$thisrows, ($thisrows-1));
		$activeSheet->setCellValue('B'.$thisrows, $a['a']);
		$activeSheet->setCellValue('C'.$thisrows, $a['b']);
		$thisrows++;
	}
}
	

//设置边框
$activeSheet->getStyle('A1:C'.($thisrows-1))
			->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// 设置页面文字的方向和页面大小    锚：bbb
$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup:: PAPERSIZE_A4);     //A4纸大小

// Redirect output to a client’s web browser (Excel5)
$filename = '统计数据';
if(strpos($_SERVER["HTTP_USER_AGENT"],"Windows")) $filename = urlencode($filename);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
