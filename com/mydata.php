<?php
header("Content-Type: text/html; charset=UTF-8");
require 'com/db.php';
require 'PHPExcel/PHPExcel.php';

$limit = $_GET['id'];
$limits = explode('-',$limit);
$db = new db();
$sql = 'select * from lmzm_tree order by id asc limit '.$limits[0].','.$limits[1];
$data = $db->prepare_query($sql);

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
$activeSheet->getColumnDimension('B')->setWidth(15);
$activeSheet->getColumnDimension('C')->setWidth(15);
$activeSheet->getColumnDimension('D')->setWidth(15);
$activeSheet->getColumnDimension('E')->setWidth(15);
$activeSheet->getColumnDimension('F')->setWidth(15);
$activeSheet->getColumnDimension('G')->setWidth(15);
$activeSheet->getColumnDimension('H')->setWidth(15);
$activeSheet->getColumnDimension('I')->setWidth(15);
$activeSheet->getColumnDimension('J')->setWidth(15);
$activeSheet->getColumnDimension('K')->setWidth(15);
$activeSheet->getColumnDimension('L')->setWidth(15);
// 居中 左偏 右偏
$activeSheet->getStyle('A:H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$activeSheet->setCellValue('A1', 'ID');
$activeSheet->setCellValue('B1', '公司id');
$activeSheet->setCellValue('C1', '树名');
$activeSheet->setCellValue('D1', '类型');
$activeSheet->setCellValue('E1', '胸径');
$activeSheet->setCellValue('F1', '地径');
$activeSheet->setCellValue('G1', '冠幅');
$activeSheet->setCellValue('H1', '株高');
$activeSheet->setCellValue('I1', '分支点');
$activeSheet->setCellValue('J1', '土球粒径');
$activeSheet->setCellValue('K1', '数量');
$activeSheet->setCellValue('L1', '价格');

$n = count($data);
for ($i=0; $i < $n; $i++) { 
	$a = $data[$i];
	$activeSheet->setCellValue('A'.($i+2), $a['id']);
	$activeSheet->setCellValue('B'.($i+2), $a['lmzm_user_id']);
	$activeSheet->setCellValue('C'.($i+2), $a['tree_name']);
	$activeSheet->setCellValue('D'.($i+2), $a['type']);
	$activeSheet->setCellValue('E'.($i+2), (((int)$a['trunk_diameter']*10)/10) ? (((int)$a['trunk_diameter']*10)/10) : '');
	$activeSheet->setCellValue('F'.($i+2), (((int)$a['ground_diameter']*10)/10) ? (((int)$a['ground_diameter']*10)/10) : '');
	$activeSheet->setCellValue('G'.($i+2), (((int)$a['crown']*10)/10) ? (((int)$a['crown']*10)/10) : '');
	$activeSheet->setCellValue('H'.($i+2), (((int)$a['plant_height']*10)/10) ? (((int)$a['plant_height']*10)/10) : '');
	$activeSheet->setCellValue('I'.($i+2), (((int)$a['branch_point_height']*10)/10) ? (((int)$a['branch_point_height']*10)/10) : '');
	$activeSheet->setCellValue('J'.($i+2), $a['ball'] ? $a['ball'] : '');
	$activeSheet->setCellValue('K'.($i+2), $a['count'] ? $a['count'] : '');
	$activeSheet->setCellValue('L'.($i+2), $a['price'] ? $a['price'] : '');
}




//设置边框
$activeSheet->getStyle('A1:L'.($n+1))
			->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);




// 设置页面文字的方向和页面大小    锚：bbb  
$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup:: PAPERSIZE_A4);     //A4纸大小



// Redirect output to a client’s web browser (Excel5)
$filename = $limit.'数据';
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



