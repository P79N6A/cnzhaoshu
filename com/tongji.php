<?php
header("Content-Type: text/html; charset=UTF-8");
require 'db.php';
require '../PHPExcel/PHPExcel.php';
$db = new db();

$type = $_GET['type'];
$lows = 0;
if ($_GET['searcharray']) {
	$searcharray = $_GET['searcharray'];
	$searcharray = json_decode($searcharray);
	$lows = count($searcharray);
	$searchtype = ($type === '落叶乔木') ? 'trunk_diameter' : 'plant_height';
}

$zimu = ['E','F','G','H'];



$sql = 'select distinct(aliases_name) a,sum(count) b from lmzm_tree where type=? group by a order by b desc';
$data = $db->prepare_query($sql,array($type));
$n = count($data);

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
$activeSheet->getColumnDimension('D')->setWidth(20);

for ($i=0; $i < $lows; $i++) { 
	$activeSheet->getColumnDimension($zimu[$i])->setWidth(20);
}

// 居中 左偏 右偏
$activeSheet->getStyle('A:H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$activeSheet->setCellValue('A1', '序号');
$activeSheet->setCellValue('B1', '树种');
$activeSheet->setCellValue('C1', '类别');
$activeSheet->setCellValue('D1', '数量');

for ($i=0; $i < $lows; $i++) { 
	$activeSheet->setCellValue($zimu[$i].'1', $searcharray[$i]);
}

for ($i=0; $i < $n; $i++) {
	$a = $data[$i];
	$name = $a['a'];
	$activeSheet->setCellValue('A'.($i+2), (1+$i));
	$activeSheet->setCellValue('B'.($i+2), $name);
	$activeSheet->setCellValue('C'.($i+2), $type);
	$activeSheet->setCellValue('D'.($i+2), $a['b']);

	for ($j=0; $j < $lows; $j++) { 
		$split = explode('-' , $searcharray[$j]);
		$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and ('.$searchtype.' >= ? and '.$searchtype.' > ?)';
		$result = $db->prepare_query($sql,array($type,$name,$split[0],$split[1]));
		if($result[0]){
			$activeSheet->setCellValue($zimu[$j].($i+2), $result[0]['a']);
		}else{
			$activeSheet->setCellValue($zimu[$j].($i+2), '0');
		}
	}

}

if ($lows) {
	$mm = $zimu[$lows-1];
} else {
	$mm = 'D';
}
//设置边框
$activeSheet->getStyle('A1:'.$mm.($n+1))
			->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// 设置页面文字的方向和页面大小    锚：bbb
$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup:: PAPERSIZE_A4);     //A4纸大小

// Redirect output to a client’s web browser (Excel5)
$filename = $type.'统计数据';
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



