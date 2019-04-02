<?php
header("Content-Type: text/html; charset=UTF-8");
require 'db.php';
require '../PHPExcel/PHPExcel.php';
$db = new db();

$type = $_GET['type'];

// pingyuan,qianshan,lengliang,tongyong

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
$activeSheet->getColumnDimension('E')->setWidth(20);
$activeSheet->getColumnDimension('F')->setWidth(20);
$activeSheet->getColumnDimension('G')->setWidth(20);
$activeSheet->getColumnDimension('H')->setWidth(20);
$activeSheet->getColumnDimension('I')->setWidth(20);
$activeSheet->getColumnDimension('J')->setWidth(20);
$activeSheet->getColumnDimension('K')->setWidth(20);
$activeSheet->getColumnDimension('L')->setWidth(20);
$activeSheet->getColumnDimension('M')->setWidth(20);
$activeSheet->getColumnDimension('N')->setWidth(20);
// 居中 左偏 右偏
$activeSheet->getStyle('A:N')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$activeSheet->setCellValue('A1', '序号');
$activeSheet->setCellValue('B1', '树种');
$activeSheet->setCellValue('C1', '类别');
$activeSheet->setCellValue('D1', '数量');
$activeSheet->setCellValue('E1', '≤1m');
$activeSheet->setCellValue('F1', '1-1.5m');
$activeSheet->setCellValue('G1', '1.5-2m');
$activeSheet->setCellValue('H1', '2-2.5m');
$activeSheet->setCellValue('I1', '2.5-3m');
$activeSheet->setCellValue('J1', '3-3.5m');
$activeSheet->setCellValue('K1', '3.5-4m');
$activeSheet->setCellValue('L1', '4-4.5m');
$activeSheet->setCellValue('M1', '4.5-5m');
$activeSheet->setCellValue('N1', '>5m');

for ($i=0; $i < $n; $i++) {
	$a = $data[$i];
	$activeSheet->setCellValue('A'.($i+2), (1+$i));
	$activeSheet->setCellValue('B'.($i+2), $a['a']);
	$activeSheet->setCellValue('C'.($i+2), $type);
	$activeSheet->setCellValue('D'.($i+2), $a['b']);

	$name = $a['a'];
	$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and (plant_height <= 1 or plant_height is null)';
	$result = $db->prepare_query($sql,array($type,$name));
	if($result[0]){
		$activeSheet->setCellValue('E'.($i+2), $result[0]['a']);
	}else{
		$activeSheet->setCellValue('E'.($i+2), '0');
	}

	$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and (plant_height > 1 and plant_height <= 1.5)';
	$result = $db->prepare_query($sql,array($type,$name));
	if($result[0]){
		$activeSheet->setCellValue('F'.($i+2), $result[0]['a']);
	}else{
		$activeSheet->setCellValue('F'.($i+2), '0');
	}

	$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and (plant_height > 1.5 and plant_height <= 2)';
	$result = $db->prepare_query($sql,array($type,$name));
	if($result[0] != null){
		$activeSheet->setCellValue('G'.($i+2), $result[0]['a']);
	}else{
		$activeSheet->setCellValue('G'.($i+2), '0');
	}

	$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and (plant_height > 2 and plant_height <= 2.5)';
	$result = $db->prepare_query($sql,array($type,$name));
	if($result[0] != null){
		$activeSheet->setCellValue('H'.($i+2), $result[0]['a']);
	}else{
		$activeSheet->setCellValue('H'.($i+2), '0');
	}

	$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and (plant_height > 2.5 and plant_height <= 3)';
	$result = $db->prepare_query($sql,array($type,$name));
	if($result[0] != null){
		$activeSheet->setCellValue('I'.($i+2), $result[0]['a']);
	}else{
		$activeSheet->setCellValue('I'.($i+2), '0');
	}

	$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and (plant_height > 3 and plant_height <= 3.5)';
	$result = $db->prepare_query($sql,array($type,$name));
	if($result[0] != null){
		$activeSheet->setCellValue('J'.($i+2), $result[0]['a']);
	}else{
		$activeSheet->setCellValue('J'.($i+2), '0');
	}

	$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and (plant_height > 3.5 and plant_height <= 4)';
	$result = $db->prepare_query($sql,array($type,$name));
	if($result[0] != null){
		$activeSheet->setCellValue('K'.($i+2), $result[0]['a']);
	}else{
		$activeSheet->setCellValue('K'.($i+2), '0');
	}

	$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and (plant_height > 4 and plant_height <= 4.5)';
	$result = $db->prepare_query($sql,array($type,$name));
	if($result[0] != null){
		$activeSheet->setCellValue('L'.($i+2), $result[0]['a']);
	}else{
		$activeSheet->setCellValue('L'.($i+2), '0');
	}

	$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and (plant_height > 4.5 and plant_height <= 5)';
	$result = $db->prepare_query($sql,array($type,$name));
	if($result[0] != null){
		$activeSheet->setCellValue('M'.($i+2), $result[0]['a']);
	}else{
		$activeSheet->setCellValue('M'.($i+2), '0');
	}

	$sql = 'select sum(count) a from lmzm_tree where type=? and aliases_name=? and plant_height > 5';
	$result = $db->prepare_query($sql,array($type,$name));
	if($result[0]){
		$activeSheet->setCellValue('N'.($i+2), $result[0]['a']);
	}else{
		$activeSheet->setCellValue('N'.($i+2), '0');
	}
}

//设置边框
$activeSheet->getStyle('A1:N'.($n+1))
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

