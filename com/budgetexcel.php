<?php
header("Content-Type: text/html; charset=UTF-8");

require '../PHPExcel/PHPExcel.php';
require 'db2.php';


$userid = $_GET['userid'];	
$addressprices = $_GET['addressprices'];
$orderid = $_GET['orderid'];

$db = new db();
$sql = 'select * from tree_order_index where id = ?';
$result = $db->prepare_query($sql , array($orderid))[0];

$ordername = $result['ordername'];

$sql = 'select * from tree_order_temp where orderid = ?';
$datas = $db->prepare_query($sql , array($orderid));

unset($db);
if($addressprices == 1){
	$n = 0;
	$cols = 'F';
}else{
	$addressprices = json_decode($addressprices, true);
	$n = 0;
	foreach ($addressprices[0] as $key => $value) {
		if($key != 'id'){
			$Provinces[$n] = $key;
			$n++;
		}
	}
	$n = count($Provinces);
}


$zimu = ['G','H','I','J','K','L','M','N','O','P','Q','R'];

for ($i=0; $i < $n; $i++) { 
	$cols = $zimu[$i];
}

// echo '<pre>';
// var_dump($addressprices);

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
$activeSheet->getColumnDimension('B')->setWidth(18);
$activeSheet->getColumnDimension('C')->setWidth(20);
$activeSheet->getColumnDimension('D')->setWidth(60);
$activeSheet->getColumnDimension('E')->setWidth(10);
$activeSheet->getColumnDimension('F')->setWidth(10);
for ($i=0; $i < $n; $i++) { 
	$activeSheet->getColumnDimension($zimu[$i])->setWidth(15);
}


$activeSheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
for ($i=0; $i < $n; $i++) { 
	$activeSheet->getStyle($zimu[$i])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}



$datacount = count($datas);
$endrow = $datacount + 3;

$sheng = [];
$activeSheet
            ->setCellValue('A2', '序号')
			->setCellValue('B2', '子目编码')
			->setCellValue('C2', '子目名称')
			->setCellValue('D2', '子目特征描述')
			->setCellValue('E2', '计量单位')
			->setCellValue('F2', '工程量');
for ($i=0; $i < $n; $i++) { 
	$activeSheet->setCellValue($zimu[$i].'2', $Provinces[$i]);
}
		
$rols = 0;
$mark = 0;
$total_price = [];
for($i=0; $i < $datacount; $i++){
		$row = $i + 3 + $rols;
		$data = $datas[$i];
		if(($i == 0 || $datas[$i]['type'] != $datas[$i-1]['type']) && $mark != 1){
			$activeSheet->setCellValue('A'.$row, '');
			$activeSheet->setCellValue('B'.$row, '');
			$activeSheet->setCellValue('C'.$row, $data['typename']);
			$activeSheet->setCellValue('D'.$row,'');
			$activeSheet->setCellValue('E'.$row, '');
			$activeSheet->setCellValue('F'.$row, '');
			for ($x=0; $x < $n; $x++) { 
				$activeSheet->setCellValue($zimu[$x].$row, '');
			}
			$rols = $rols+1;
			$i--;
			$mark = 1;
		}else{
			$mark = 0;
			$attribute = '';
			
			if($data['trunk_diameter']){
				$trunk_diameter = explode(',', $data['trunk_diameter']);
				if(count($trunk_diameter) > 1){
					$attribute .= '胸径'.$trunk_diameter[0].'-'.$trunk_diameter[1].'cm，';
				}else if($trunk_diameter[0]){
					$attribute .= '胸径'.$trunk_diameter[0].'cm，';
				}
			}

			if($data['ground_diameter']){
				$ground_diameter = explode(',', $data['ground_diameter']);
				if(count($ground_diameter) > 1){
					$attribute .= '地径'.$ground_diameter[0].'-'.$ground_diameter[1].'cm，';
				}else if($ground_diameter[0]){
					$attribute .= '地径'.$ground_diameter[0].'cm，';
				}
			}

			if($data['pot_diameter']){
				$pot_diameter = explode(',', $data['pot_diameter']);
				if(count($pot_diameter) > 1){
					$attribute .= '盆径'.$pot_diameter[0].'-'.$pot_diameter[1].'cm，';
				}else if($pot_diameter[0]){
					$attribute .= '盆径'.$pot_diameter[0].'cm，';
				}
			}

			if($data['age']){
				$attribute .= '苗龄'.$data['age'][0].'年，';
			}

			
			if($data['plant_height']){
				$plant_height = explode(',', $data['plant_height']);
				if(count($plant_height) > 1){
					$attribute .= '株高'.((float)$plant_height[0]*100).'-'.((float)$plant_height[1]*100).'cm，';
				}else if($plant_height[0]){
					$attribute .= '株高'.((float)$plant_height[0]*100).'cm，';
				}
			}

			if($data['plant_height_cm']){
				$plant_height_cm = explode(',', $data['plant_height_cm']);
				if(count($plant_height_cm) > 1){
					$attribute .= '株高'.((float)$plant_height_cm[0]).'-'.((float)$plant_height_cm[1]).'cm，';
				}else if($plant_height_cm[0]){
					$attribute .= '株高'.((float)$plant_height_cm[0]).'cm，';
				}
			}

			if($data['crown']){
				$crown = explode(',', $data['crown']);
				if(count($crown) > 1){
					$attribute .= '冠幅'.((float)$crown[0]*100).'-'.((float)$crown[1]*100).'cm，';
				}else if($crown[0]){
					$attribute .= '冠幅'.((float)$crown[0]*100).'cm，';
				}
			}

			if($data['crown_cm']){
				$crown_cm = explode(',', $data['crown_cm']);
				if(count($crown_cm) > 1){
					$attribute .= '冠幅'.((float)$crown_cm[0]).'-'.((float)$crown_cm[1]).'cm，';
				}else if($crown_cm[0]){
					$attribute .= '冠幅'.((float)$crown_cm[0]).'cm，';
				}
			}

			if($data['branch_length']){
				$branch_length = explode(',', $data['branch_length']);
				if(count($branch_length) > 1){
					$attribute .= '分枝长'.((float)$branch_length[0]*100).'-'.((float)$branch_length[1]*100).'cm，';
				}else if($branch_length[0]){
					$attribute .= '分枝长'.((float)$branch_length[0]*100).'cm，';
				}
			}

			if($data['bough_length']){
				$bough_length = explode(',', $data['bough_length']);
				if(count($bough_length) > 1){
					$attribute .= '主枝长'.((float)$bough_length[0]*100).'-'.((float)$bough_length[1]*100).'cm，';
				}else if($bough_length[0]){
					$attribute .= '主枝长'.((float)$bough_length[0]*100).'cm，';
				}
			}

			if($data['branch_point_height']){
				$branch_point_height = explode(',', $data['branch_point_height']);
				if(count($branch_point_height) > 1){
					$attribute .= '分枝点高'.((float)$branch_point_height[0]*100).'-'.((float)$branch_point_height[1]*100).'cm，';
				}else if($branch_point_height[0]){
					$attribute .= '分枝点高'.((float)$branch_point_height[0]*100).'cm，';
				}
			}

			if($data['branch_number']){
				$branch_number = explode(',', $data['branch_number']);
				if(count($branch_number) > 1){
					$attribute .= '分枝数'.$branch_number[0].'-'.$branch_number[1].'个，';
				}else if($branch_number[0]){
					$attribute .= '分枝数'.$branch_number[0].'个，';
				}
			}

			if($data['bough_number']){
				$bough_number = explode(',', $data['bough_number']);
				if(count($bough_number) > 1){
					$attribute .= '主枝数'.$bough_number[0].'-'.$bough_number[1].'个，';
				}else if($bough_number[0]){
					$attribute .= '主枝数'.$bough_number[0].'个，';
				}
			}

			if($data['substrate']){
				$attribute .= '基质:'.$data['substrate'].'，';
			}
			$attribute = rtrim($attribute, "，");

			$activeSheet->setCellValue('A'.$row, $i+1);
			$activeSheet->setCellValue('B'.$row, $data['id']);
			$activeSheet->setCellValue('C'.$row, $data['name']);
			$activeSheet->setCellValue('D'.$row, '1.规格: '.$attribute);

			$activeSheet->setCellValue('E'.$row, $data['unit']);
			$activeSheet->setCellValue('F'.$row, $data['count']);
			for ($y=0; $y < count($addressprices); $y++) { 
				if($addressprices[$y]['id'] == $data['id']){
					for ($x=0; $x < $n; $x++) {
						$activeSheet->setCellValue($zimu[$x].$row, round($addressprices[$y][$Provinces[$x]],1));
						$total_price[$x] += $addressprices[$y][$Provinces[$x]]*$data['count'];
					}
				}
			}

		}

}


$endrow = $endrow + $rols;
$activeSheet->setCellValue('A'.$endrow, '合计');
// 数量统计
$activeSheet->setCellValue('F'.$endrow, '=SUM(F3:F'.($endrow-1).')');
for ($i=0; $i < $n; $i++) { 
	$activeSheet->setCellValue($zimu[$i].$endrow, '='.round($total_price[$i],1));
}

$activeSheet->mergeCells('A'.$endrow.':E'.$endrow);
$activeSheet->getStyle('A'.$endrow)->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


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
