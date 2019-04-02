<?php
header("Content-Type: text/html; charset=UTF-8");

require '../PHPExcel/PHPExcel.php';
require 'db2.php';


$userid = $_GET['userid'];	
$orderid = $_GET['orderid'];

$db = new db();
$sql = 'select * from tree_order_index where id = ?';
$result = $db->prepare_query($sql , array($orderid))[0];

$ordername = $result['ordername'];

$sql = 'select * from tree_order where orderid = ?';
$data = $db->prepare_query($sql , array($orderid));

$sql = 'select a.id,a.number,a.price,b.name,b.phone from (select * from bid_order where orderid = ? and state=2) a left join (select name,phone,userid from user) b on a.userid = b.userid';
$biddata = $db->prepare_query($sql , array($orderid));

$datas = [];
for ($i=0; $i < count($data); $i++) { 
	$datas[$i] = [];
	foreach ($data[$i] as $key => $value) {
		if($value){
			$datas[$i][$key] = $value;
		}
	}
}

$attribute = ['trunk_diameter','ground_diameter','pot_diameter','age','plant_height','crown','branch_length','bough_length','branch_point_height','branch_number','bough_number','plant_height_cm','crown_cm','substrate','mark'];
$attributename = ['胸径(公分)','地径(公分)','盆径(公分)','苗龄(年)','株高(米)','冠幅(米)','分枝长(米)','主枝长(米)','分枝点高(米)','分枝数(个)','主枝数(个)','株高(公分)','冠幅(公分)','基质','备注'];
$noattributedata = ['id','name','type','typename','unit','count','userid','orderid'];

$attr = [];
for ($i=0; $i < count($datas); $i++) { 
	foreach ($datas[$i] as $key => $value) {
		if(!in_array($key, $noattributedata)){
			if(!in_array($key, $attr)) array_push($attr, $key);
		}
	}
}

$title1 = [];
$title2 = [];
for ($j=0; $j < count($attribute); $j++) { 
	for ($i=0; $i < count($attr); $i++) { 
		if($attr[$i] == $attribute[$j]){
			array_push($title1, $attr[$i]);
			array_push($title2, $attributename[$j]);
		}
	}
}


unset($db);
$people = [];
$m = 0;
if($biddata){	
	for ($i=0; $i < count($biddata); $i++) { 
		if($people[$biddata[$i]['id']]){
			$people[$biddata[$i]['id']]++;
		}else{
			$people[$biddata[$i]['id']] = 1;
		}	
	}
	foreach ($people as $key => $value) {
		if($m < $value) $m = $value;
	}
}

$zimu = ['F','G','H','I','J','K','L','M','N','O','P','Q','R'];

$n = count($title1)+$m;
$cols = $zimu[$n-1];


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
$objPHPExcel->setActiveSheetIndex(0);

$activeSheet = $objPHPExcel->getActiveSheet();
$activeSheet->getDefaultStyle()->getFont()->setSize(11);
//设置默认行高
$activeSheet->getDefaultRowDimension()->setRowHeight(20);
$activeSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

//合并单元格
$activeSheet
			->mergeCells('A1:'.$cols.'1')
            ->setCellValue('A1', $ordername)
			->getStyle('A1')->getFont()->setSize(24);

$activeSheet->getStyle('A1')->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$activeSheet->getRowDimension('1')->setRowHeight(50);
$activeSheet->getColumnDimension('A')->setWidth(10);
$activeSheet->getColumnDimension('B')->setWidth(20);
$activeSheet->getColumnDimension('C')->setWidth(10);
$activeSheet->getColumnDimension('D')->setWidth(10);
$activeSheet->getColumnDimension('E')->setWidth(10);
for ($i=0; $i < $n; $i++) {
	if($i < count($title2)){ 
		$activeSheet->getColumnDimension($zimu[$i])->setWidth(20);
	}else{
		$activeSheet->getColumnDimension($zimu[$i])->setWidth(60);
	}
}


$activeSheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
$activeSheet->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
for ($i=0; $i < $n; $i++) { 
	
	if($i < count($title2)){ 
		$activeSheet->getStyle($zimu[$i])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	}else{
		$activeSheet->getStyle($zimu[$i].'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	}
}

$datacount = count($datas);
$endrow = $datacount + 2;


$activeSheet
            ->setCellValue('A2', '序号')
			->setCellValue('B2', '编码')
			->setCellValue('C2', '名称')
			->setCellValue('D2', '单位')
			->setCellValue('E2', '数量');
for ($i=0; $i < $n; $i++) { 
	if($i < count($title2)){
		$activeSheet->setCellValue($zimu[$i].'2', $title2[$i]);
	}else{
		$activeSheet->setCellValue($zimu[$i].'2', '中标方信息');
	}		
}

	
$row = 2;
for($i=0; $i < $datacount; $i++){
		$row++;
		$data = $datas[$i];
		$activeSheet->setCellValue('A'.$row, $i+1);
		$activeSheet->setCellValue('B'.$row, " ".$data['id']);
		$activeSheet->setCellValue('C'.$row, $data['name']);
		$activeSheet->setCellValue('D'.$row, $data['unit']);
		$activeSheet->setCellValue('E'.$row, $data['count']);


		for ($j=0; $j < $n; $j++) { 
			if($j < count($title2)){
				$thisattr = explode(',', $data[$title1[$j]]);
				if(count($thisattr)>1){
					$thisattr = implode('-', $thisattr);
				}else{
					$thisattr = $thisattr[0];
				}

				$activeSheet->setCellValue($zimu[$j].$row, $thisattr);
			}		
		}

		$w = count($title2);
		for ($k=0; $k < count($biddata); $k++) { 
			if($biddata[$k]['id'] == $data['id']){
				$activeSheet->setCellValue($zimu[$w].$row, $biddata[$k]['name'].' '.($biddata[$k]['price']/100).'元/'.$data['unit'].',  '.$biddata[$k]['number'].$data['unit'].'-----'.$biddata[$k]['phone']);
				$w++;
			}
		}
}



//设置边框
$activeSheet->getStyle('A2:'.$cols.$endrow)
        ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$activeSheet->getStyle('A2:'.$cols.$endrow)
        ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$activeSheet->getStyle('A2:'.$cols.$endrow)
        ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$activeSheet->getStyle('A2:'.$cols.$endrow)
        ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$activeSheet->getStyle('A2:'.$cols.$endrow)
        ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$activeSheet->getStyle('A2:'.$cols.$endrow)
        ->getBorders()->getHorizontal()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);



// 设置页面文字的方向和页面大小    锚：bbb  
$activeSheet->getPageSetup()
		// ->setOrientation(PHPExcel_Worksheet_PageSetup:: ORIENTATION_LANDSCAPE)
		->setPaperSize(PHPExcel_Worksheet_PageSetup:: PAPERSIZE_A4);     //A4纸大小  


// Redirect output to a client’s web browser (Excel5)
$filename = $ordername.date('Ymd',time());;
if(strpos($_SERVER["HTTP_USER_AGENT"],"Windows")) $filename = urlencode($filename);
// $filename = iconv("UTF-8","UTF-8",$filename);

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
