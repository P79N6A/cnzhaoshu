<?php
header("Content-Type: text/html; charset=UTF-8");
require 'com/db2.php';
require 'PHPExcel/PHPExcel.php';

$db = new db();

$sql = 'select a.company_name,a.phone,a.area,a.address,b.count,b.sum from (select company_name,phone,area,id,address from lmzm_user) a left join (select count(tree_name) count,lmzm_user_id id,sum(count) sum from lmzm_tree group by lmzm_user_id) b on a.id=b.id order by CONVERT(a.company_name USING GBK)';

$info = $db->query($sql);

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

//设置表头，合并单元格
$activeSheet->mergeCells('A1:G1')
            ->setCellValue('A1', '种苗协会统计表')
			->getStyle('A1')->getFont()->setSize(24);

$activeSheet->getStyle('A1')->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$activeSheet->getRowDimension('1')->setRowHeight(50);

// 设置宽度
$activeSheet->getRowDimension('1')->setRowHeight(50);
$activeSheet->getColumnDimension('A')->setWidth(10);
$activeSheet->getColumnDimension('B')->setWidth(45);
$activeSheet->getColumnDimension('C')->setWidth(15);
$activeSheet->getColumnDimension('D')->setWidth(20);
$activeSheet->getColumnDimension('E')->setWidth(15);
$activeSheet->getColumnDimension('F')->setWidth(15);
$activeSheet->getColumnDimension('G')->setWidth(15);

//水平居中
$activeSheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//水平居左
// $activeSheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

//水平居右
$activeSheet->getStyle('D:G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$activeSheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$activeSheet->getStyle('A2:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->setCellValue('A2', '序号');
$activeSheet->setCellValue('B2', '单位名称');
$activeSheet->setCellValue('C2', '单位所在地');
$activeSheet->setCellValue('D2', '联系方式');
$activeSheet->setCellValue('E2', '苗圃面积');
$activeSheet->setCellValue('F2', '苗木品种数');
$activeSheet->setCellValue('G2', '苗木总数');

$activeSheet->getStyle('A2:G2')->getFont()->setSize(12);
$n = count($info);
//设置边框
$activeSheet->getStyle('A1:G'.($n+2))
			->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
for ($i=0; $i < $n; $i++) { 
	$data = $info[$i];
	$activeSheet->setCellValue('A'.($i+3), ($i+1));
	$activeSheet->setCellValue('B'.($i+3), $data['company_name']);
	$activeSheet->setCellValue('C'.($i+3), $data['address']);
	$activeSheet->setCellValue('D'.($i+3), $data['phone']);
	$activeSheet->setCellValue('E'.($i+3), sprintf( "%.2f ",$data['area']));
	$activeSheet->setCellValue('F'.($i+3), $data['count']);
	$activeSheet->setCellValue('G'.($i+3), $data['sum']);
}

// 设置页面文字的方向和页面大小    锚：bbb  
$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup:: PAPERSIZE_A4);     //A4纸大小



// Redirect output to a client’s web browser (Excel5)
$filename = '种苗协会统计表';
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