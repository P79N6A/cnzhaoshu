<?php
header("Content-Type: text/html; charset=UTF-8");
require 'db3.php';
require '../PHPExcel/PHPExcel.php';

$id = $_GET['id'];

$user = json_decode($_COOKIE['user'],true);

if(($user['role'] == 6) || ($user['role'] == 8)){
	$db = new db();

	$sql = 'select projectname from adopt_project where id=?';
	$projectname = $db->prepare_query($sql,array($id))[0]['projectname'];

	if(!$projectname) exit;


	$sql = 'select c.*,d.money,d.time from (select a.qrcode,a.tree_name,b.id from adopt_tree a left join adopt_adopt b on a.id=b.tree_id where a.project_id=?) c right join adopt_order d on c.id=d.adopt_id where d.status=1';

	$info = $db->prepare_query($sql,array($id));

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
	$activeSheet->mergeCells('A1:E1')
	            ->setCellValue('A1', $projectname.'认养统计表')
				->getStyle('A1')->getFont()->setSize(24);

	$activeSheet->getStyle('A1')->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$activeSheet->getRowDimension('1')->setRowHeight(50);

	// 设置宽度
	$activeSheet->getRowDimension('1')->setRowHeight(50);
	$activeSheet->getColumnDimension('A')->setWidth(10);
	$activeSheet->getColumnDimension('B')->setWidth(20);
	$activeSheet->getColumnDimension('C')->setWidth(30);
	$activeSheet->getColumnDimension('D')->setWidth(20);
	$activeSheet->getColumnDimension('E')->setWidth(20);

	//水平居中
	$activeSheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$activeSheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$activeSheet->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$activeSheet->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	//水平居左
	// $activeSheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

	//水平居右
	// $activeSheet->getStyle('D:G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$activeSheet->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

	$activeSheet->getStyle('A2:E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$activeSheet->setCellValue('A2', '序号');
	$activeSheet->setCellValue('B2', '树名');
	$activeSheet->setCellValue('C2', '二维码');
	$activeSheet->setCellValue('D2', '认养费');
	$activeSheet->setCellValue('E2', '付款时间');

	$activeSheet->getStyle('A2:E2')->getFont()->setSize(12);
	$n = count($info);
	//设置边框
	$activeSheet->getStyle('A1:E'.($n+2))
				->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	for ($i=0; $i < $n; $i++) { 
		$data = $info[$i];
		$activeSheet->setCellValue('A'.($i+3), ($i+1));
		$activeSheet->setCellValue('B'.($i+3), $data['tree_name']);
		$activeSheet->setCellValue('C'.($i+3), $data['qrcode']);
		$activeSheet->setCellValue('D'.($i+3), $data['money']);
		$activeSheet->setCellValue('E'.($i+3), data('Y-m-d H:i:s',$data['time']));
	}

	// 设置页面文字的方向和页面大小    锚：bbb  
	$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup:: PAPERSIZE_A4);     //A4纸大小



	// Redirect output to a client’s web browser (Excel5)
	$filename = $projectname.'认养统计表';
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
}

