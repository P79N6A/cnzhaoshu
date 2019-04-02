<?php
header("Content-Type: text/html; charset=UTF-8");
require 'com/db2.php';
require 'PHPExcel/PHPExcel.php';

$db = new db();


$address = '上海';

$sql = 'select distinct name,type,dbh,dbh_type,height_type,age,height,crownwidth,branch_point_height,branch_bough_number,price,province,district,sum(count) from tree where province=? group by dbh,crownwidth,height,branch_point_height,price,city order by CONVERT(name USING gbk)';

$trees = $db->prepare_query($sql,array($address));

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
$activeSheet->mergeCells('A1:H1')
            ->setCellValue('A1', $address)
			->getStyle('A1')->getFont()->setSize(24);

$activeSheet->getStyle('A1')->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$activeSheet->getRowDimension('1')->setRowHeight(50);

if($trees){
	$data = [];
	for ($i=0; $i < count($trees); $i++) { 
		$data[$i] = [];
		$results = $trees[$i];
		foreach ($results as $key => $value) {
			if($value){
				if($key == 'dbh'){
					if($results['dbh_type'] == '5') $data[$i]['trunk_diameter'] = $value;
					if($results['dbh_type'] == '6') $data[$i]['ground_diameter'] = $value;
					if($results['dbh_type'] == '7') $data[$i]['pot_diameter'] = $value;
				}
				if($key == 'height'){
					if($results['height_type'] == '10') $data[$i]['plant_height'] = $value;
					if($results['height_type'] == '11') $data[$i]['branch_length'] = $value;
					if($results['height_type'] == '12') $data[$i]['bough_length'] = $value;
				}
				if($key == 'type' && $value == 100){
					$data[$i][$key] = 11;
				}else if($key != 'dbh_type' && $key != 'height_type' && $key != 'dbh' && $key != 'height'){
					$data[$i][$key] = $value;
				}
			}
		}
	}
	$trees = $data;
	unset($db);

	$zimu = ['C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R'];

	$typenames = ['落叶乔木','常绿乔木','落叶灌木','常绿灌木','藤木','竹类','木本花卉','宿根花卉','水生植物','地被草皮','其他'];

	$attribute = ['trunk_diameter','ground_diameter','pot_diameter','age','plant_height','crownwidth','branch_length','bough_length','branch_point_height','branch_number','bough_number'];
	$attributename =['胸径(公分)','地径(公分)','盆径(公分)','苗龄(年)','株高(米)','冠幅(米)','条长(米)','主枝长(米)','分枝点高(米)','分枝数(个)','主枝数(个)'];
	$noattributedata = ['name','type','price','username','userphone','province','district','count'];

	// 显示不同页码
	$colslength = [];
	$collength = [];


	$datapage = [];
	for ($page=0; $page < 11; $page++) { 
		
		$attributenumber = 0;
		// data[$i]的key
		$colslength[$page] = [];
		// 本页类型数据
		// 遍历数据数据
		$datapage[$page] = [];
		$d = 0;
		for ($i=0; $i < count($trees); $i++) {
			// 取出类型与页码匹配的数据
			if($trees[$i]['type'] == ($page+1)){
				$datapage[$page][$d] = $trees[$i];
				$datapage[$page][$d]['typename'] = $typenames[$page];
				$d++;
				$col = array_keys($trees[$i]);
				for ($j=0; $j < count($col); $j++) { 
					if(!in_array($col[$j],$colslength[$page])){
						$colslength[$page][$attributenumber] = $col[$j];
						$attributenumber++;
					}
				}
			}

		}
		if($colslength[$page]){
			$collength[$page] = [];
			$attributenumber = 0;
			for ($i=0; $i < count($colslength[$page]) ; $i++) { 
				if(!in_array($colslength[$page][$i],$noattributedata)){
					$collength[$page][$attributenumber] = $colslength[$page][$i];
					$attributenumber++;
				}
			}
		}
	}

	$m = 0;
	for ($i=0; $i < 11; $i++) {

		if(count($collength[$i]) > $m){
			$m = count($collength[$i]);
		}
	}

	$ncollength = [];
	for ($j=0; $j < 11; $j++) { 
	$z = 0;
	$ncollength[$j] = [];
		for ($i=0; $i < count($attribute); $i++) { 
			for ($y=0; $y < count($collength[$j]); $y++) { 
				if($attribute[$i] == $collength[$j][$y]){
					$ncollength[$j][$z] = $collength[$j][$y];
					$z++;
				}
			}
		}
	}
	$collength = $ncollength;
	function filterEmoji($str)
	{
	    $str = preg_replace_callback(
	            '/./u',
	            function (array $match) {
	                return strlen($match[0]) >= 4 ? '' : $match[0];
	            },
	            $str);

	     return $str;
	 }


	for ($i=0; $i < ($m+5); $i++) { 
		$cols = $zimu[$i];
	}
				
					
	// 设置宽度
	$activeSheet->getColumnDimension('A')->setWidth(10);
	$activeSheet->getColumnDimension('B')->setWidth(15);
	for ($i=0; $i < ($m+2); $i++) { 
		$activeSheet->getColumnDimension($zimu[$i])->setWidth(12);
	}
	$activeSheet->getColumnDimension($zimu[$m+2])->setWidth(15);
	$activeSheet->getColumnDimension($zimu[$m+3])->setWidth(40);
	$activeSheet->getColumnDimension($zimu[$m+4])->setWidth(15);
	// 居中 左偏 右偏
	$activeSheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$activeSheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	for ($i=0; $i < ($m+5); $i++) { 
		$activeSheet->getStyle($zimu[$i])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	}

	// 不同之处
	$rows = 1;
	$typenumber = 0;
	$total_price = [];
	$pagetemp = 0;
	for ($page=0; $page < 11; $page++) { 
		if(count($datapage[$page])){
			$datacount = count($datapage[$pagetemp]);

			$rows += ($datacount + 2)*$typenumber;
			$typenumber = 1;
			$pagetemp = $page;
			$endrow = count($datapage[$page]) + $rows + 2;
			
			$sheng = [];
			$activeSheet
						->mergeCells('A'.($rows+1).':'.$cols.($rows+1))
			            ->setCellValue('A'.($rows+1).'', $datapage[$page][0]['typename'])
						->getStyle('A'.($rows+1).'')->getFont()->setSize(15);
			// 设置表头
			$activeSheet
			            ->setCellValue('A'.($rows+2).'', '序号')
						->setCellValue('B'.($rows+2).'', '名称' );
		
			for ($j=0; $j < count($attribute); $j++) { 
				for ($i=0; $i < $m; $i++) { 
					if($attribute[$j] == $collength[$page][$i]){
						$activeSheet->setCellValue($zimu[$i].($rows+2), $attributename[$j]);
					}
				}
			}
			$activeSheet->setCellValue($zimu[$m].($rows+2), '数量(株)');
			$activeSheet->setCellValue($zimu[$m+1].($rows+2), '价格(元)');

			// 填写内容

			$total_price[$page] = [];
			$attributedata = [];
			$totalcount = 0;
			for ($i=0; $i < count($datapage[$page]); $i++) {
				$row = $i + $rows + 3;
				$data = $datapage[$page][$i];
				$activeSheet->setCellValue('A'.$row, $i+1);
				$activeSheet->setCellValue('B'.$row, $data['name']);
				for ($z=0; $z < $m; $z++) { 
					for ($j=0; $j < count($attribute); $j++) { 
						if($attribute[$j] == $collength[$page][$z]){
							$activeSheet->setCellValue($zimu[$z].$row, $data[$attribute[$j]]);
						}
					}
				}

				$activeSheet->setCellValue($zimu[$m].$row, $data['count']);
				$activeSheet->setCellValue($zimu[$m+1].$row, $data['price']);
			}
				
		}
	}
	// 不同之处
	//设置边框
	$activeSheet->getStyle('A2:'.$cols.$endrow)
	        	->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
}else{	
	// 设置宽度
	$activeSheet->getRowDimension('1')->setRowHeight(50);
	$activeSheet->getColumnDimension('A')->setWidth(15);
	$activeSheet->getColumnDimension('B')->setWidth(15);
	$activeSheet->getColumnDimension('C')->setWidth(15);
	$activeSheet->getColumnDimension('D')->setWidth(15);
	$activeSheet->getColumnDimension('E')->setWidth(15);
	// 居中 左偏 右偏
	$activeSheet->getStyle('A:H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$activeSheet->setCellValue('A2', '序号');
	$activeSheet->setCellValue('B2', '名称');
	$activeSheet->setCellValue('C2', '规格');
	$activeSheet->setCellValue('D2', '数量(株)');
	$activeSheet->setCellValue('E2', '价格(元)');
	//设置边框
	$activeSheet->getStyle('A2:H4')
				->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
}



// 设置页面文字的方向和页面大小    锚：bbb  
$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup:: PAPERSIZE_A4);     //A4纸大小



// Redirect output to a client’s web browser (Excel5)
$filename = $address;
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