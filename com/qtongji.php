<?php
header("Content-Type: text/html; charset=UTF-8");
require 'db.php';
require '../PHPExcel/PHPExcel.php';

// 大兴
// 房山
// 顺义
// 通州
// 昌平
// 延庆
// 朝阳
// 丰台
// 海淀
// 怀柔
// 密云
// 平谷
// 门头沟
//
$names = $_GET['name'];

$db = new db();
$sql = 'select distinct(c.aliases_name) a,sum(c.count) b from lmzm_tree c left join lmzm_user d on c.lmzm_user_id=d.id where d.address=? group by a order by b desc limit 0,10';
$data = $db->prepare_query($sql,array($names));
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
$activeSheet->getColumnDimension('A')->setWidth(20);
$activeSheet->getColumnDimension('B')->setWidth(20);
$activeSheet->getColumnDimension('C')->setWidth(20);
$activeSheet->getColumnDimension('D')->setWidth(20);
// 居中 左偏 右偏
$activeSheet->getStyle('A:C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$activeSheet->setCellValue('A1', '序号');
$activeSheet->setCellValue('B1', '树种');
$activeSheet->setCellValue('C1', '数量');
$activeSheet->setCellValue('D1', '地区');


for ($i=0; $i < $n; $i++) {
	$a = $data[$i];
	$activeSheet->setCellValue('A'.($i+2), (1+$i));
	$activeSheet->setCellValue('B'.($i+2), $a['a']);
	$activeSheet->setCellValue('C'.($i+2), $a['b']);
	$activeSheet->setCellValue('D'.($i+2), $names);
}



//设置边框
$activeSheet->getStyle('A1:D'.($n+1))
			->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);




// 设置页面文字的方向和页面大小    锚：bbb
$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup:: PAPERSIZE_A4);     //A4纸大小



// Redirect output to a client’s web browser (Excel5)
$filename = '地区统计数据';
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



