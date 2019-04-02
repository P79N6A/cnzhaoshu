<?php
header("Content-Type: text/html; charset=UTF-8");
require 'checkhost.php';
require 'db2.php';
require '../PHPExcel/PHPExcel.php';



$userid = $_GET['userid'];	
$addressprices = $_GET['addressprices'];
$orderid = $_GET['orderid'];

$db = new db();
$sql = 'select a.*,user.name,user.phone from (select * from tree_order_index where id = ?) a left join user on a.userid=user.userid';
$result = $db->prepare_query($sql , array($orderid))[0];

$ordername = $result['ordername'];
$useraddress = $result['address'];
$shopname = $result['name'];
$shopphone = $result['phone'];


$sql = 'select * from tree_order_temp where orderid = ?';
$result1 = $db->prepare_query($sql , array($orderid));

$datas = [];
for ($i=0; $i < count($result1); $i++) { 
	$datas[$i] = [];
	foreach ($result1[$i] as $key => $value) {
		if($value){
			$datas[$i][$key] = $value;
		}
	}
}

unset($db);

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
 $shopname = filterEmoji($shopname);


if(!$useraddress){
	$useraddress = '';
}

$Province = [];	
if($addressprices == 1){
	$n = 1;
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

$zimu = ['C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R'];



$attribute = ['trunk_diameter','ground_diameter','pot_diameter','age','plant_height','crown','branch_length','bough_length','branch_point_height','branch_number','bough_number','plant_height_cm','crown_cm','substrate'];
$attributename = ['胸径','地径','盆径','苗龄','株高','冠幅','分枝长','主枝长','分枝点高','分枝数','主枝数','株高','冠幅','基质'];
$noattributedata = ['id','name','type','typename','unit','count','userid','orderid'];
// 显示不同页码
$colslength = [];
$collength = [];




$addressdatapage = [];
$datapage = [];
for ($page=0; $page < 11; $page++) { 
	
	$attributenumber = 0;
	// data[$i]的key
	$colslength[$page] = [];
	// 本页类型数据
	// 遍历数据数据
	$datapage[$page] = [];
	$d = 0;
	for ($i=0; $i < count($datas); $i++) {
		// 取出类型与页码匹配的数据
		if($datas[$i]['type'] == ($page+1)){
			$datapage[$page][$d] = $datas[$i];
			for ($j=0; $j < count($addressprices); $j++) { 
				if($datas[$i]['id'] == $addressprices[$j]['id']){
					$addressdatapage[$page][$d] = $addressprices[$j];
				}
			}
			$d++;
			$col = array_keys($datas[$i]);
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

	


// for ($page=0; $page < 10; $page++) {
$m = 0;
for ($i=0; $i < 11; $i++) {

	if(count($collength[$i]) > $m){
		$m = count($collength[$i]);
	}
}
if($m > 2 && ($addressprices == 1)){
	$n = 0;
}else if($m > 1 && ($addressprices == 1)){
	$n = 1;
}else if($m > 0 && ($addressprices == 1)){
	$n = 2;
}
			// $m = count($collength[$page]);
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
			for ($i=0; $i < ($n+$m+1); $i++) { 
				$cols = $zimu[$i];
			}
// var_dump($m,$cols);			
			// Create new PHPExcel object

				$objPHPExcel = new PHPExcel();
				$objPHPExcel->setActiveSheetIndex(0);
				$activeSheet = $objPHPExcel->getActiveSheet ();

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

				//合并单元格
				$activeSheet
							->mergeCells('A1:'.$cols.'1')
				            ->setCellValue('A1', $ordername)
							->getStyle('A1')->getFont()->setSize(24);

				$activeSheet->getStyle('A1')->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
							->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				// 设置单元格
			// var_dump($datapage,$addressdatapage,111);	
				$activeSheet
							->mergeCells('A2:A2')
							->mergeCells('B2:B2')
							->mergeCells('C2:C2')
							->mergeCells('D2:D2')
							->mergeCells('E2:E2')
							->mergeCells('F2:G2');
				// 填表
				$activeSheet
							->setCellValue('A2', '公司名称:')
							->setCellValue('B2', $shopname)
							->setCellValue('C2', '联系电话:')
							->setCellValue('D2', $shopphone)
							->setCellValue('E2', '用苗地址:')
							->setCellValue('F2', $useraddress);
				$activeSheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$activeSheet->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$activeSheet->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$activeSheet->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$activeSheet->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$activeSheet->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				// var_dump($datapage,$addressdatapage,000);
				// 设置宽度
				$activeSheet->getRowDimension('1')->setRowHeight(50);
				$activeSheet->getColumnDimension('A')->setWidth(15);
				$activeSheet->getColumnDimension('B')->setWidth(40);
				for ($i=0; $i < ($n+$m+1); $i++) { 
					$activeSheet->getColumnDimension($zimu[$i])->setWidth(15);
					
				}
				// 居中 左偏 右偏
				$activeSheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$activeSheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				for ($i=0; $i < ($n+$m+1); $i++) { 
					$activeSheet->getStyle($zimu[$i])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}

// 不同之处
		$rows = 2;
		$typenumber = 0;
		$total_price = [];
		$pagetemp = 0;
		for ($page=0; $page < 11; $page++) { 
			if(count($datapage[$page])){
				$datacount = count($datapage[$pagetemp]);

				$rows += ($datacount + 3)*$typenumber;
				$typenumber = 1;
				$pagetemp = $page;
				$endrow = count($datapage[$page]) + $rows + 3;
				
				$sheng = [];
				$activeSheet
							->mergeCells('A'.($rows+1).':'.$cols.($rows+1))
				            ->setCellValue('A'.($rows+1).'', $datapage[$page][0]['typename'])
							->getStyle('A'.($rows+1).'')->getFont()->setSize(15);
				// 设置表头
				$activeSheet
				            ->setCellValue('A'.($rows+2).'', '序号')
							->setCellValue('B'.($rows+2).'', '名称' );
				
				// for ($i=0; $i < $m; $i++) { 

					for ($j=0; $j < count($attribute); $j++) { 
						for ($i=0; $i < $m; $i++) { 
							if($attribute[$j] == $collength[$page][$i]){
								$activeSheet->setCellValue($zimu[$i].($rows+2), $attributename[$j]);
							}
						}
					}
				// }
				$activeSheet->setCellValue($zimu[$m].($rows+2), '数量');

				for ($i=($m+1); $i < ($n+$m+1); $i++) { 
					$activeSheet->setCellValue($zimu[$i].($rows+2), $Provinces[$i-$m-1]);
				}
				// 填写内容

					$total_price[$page] = [];
					$attributedata = [];
					$totalcount = 0;
					for ($i=0; $i < count($datapage[$page]); $i++) {
						$row = $i + $rows + 3;
						$data = $datapage[$page][$i];
						$addressdata = $addressdatapage[$page][$i];
							for ($j=0; $j < count($attribute); $j++) { 
								if($attribute[$j] == 'trunk_diameter' || $attribute[$j] == 'ground_diameter' || $attribute[$j] == 'pot_diameter' || $attribute[$j] == 'plant_height_cm' || $attribute[$j] == 'crown_cm'){
									$att = explode(',', $data[$attribute[$j]]);
									if(count($att) > 1){
										$attributedata[$j] = $att[0].'-'.$att[1].'cm';
									}else if($att[0]){
										$attributedata[$j] = $att[0].'cm';
									}else{
										$attributedata[$j] = '';
									}

								}elseif($attribute[$j] == 'age'){
									$att = explode(',', $data[$attribute[$j]]);
									if(count($att) > 1){
										$attributedata[$j] = $att[0].'-'.$att[1].'年';
									}else if($att[0]){
										$attributedata[$j] = $att[0].'年';
									}else{
										$attributedata[$j] = '';
									}
								}elseif($attribute[$j] == 'branch_number' || $attribute[$j] == 'bough_number'){
									$att = explode(',', $data[$attribute[$j]]);
									if(count($att) > 1){
										$attributedata[$j] = $att[0].'-'.$att[1].'个';
									}else if($att[0]){
										$attributedata[$j] = $att[0].'个';
									}else{
										$attributedata[$j] = '';
									}

								}elseif($attribute[$j] == 'substrate'){
									if($data[$attribute[$j]]){
										$attributedata[$j] = $data[$attribute[$j]];
									}else{
										$attributedata[$j] = '';
									}
								}else{
									$att = explode(',', $data[$attribute[$j]]);
									if(count($att) > 1){
										$attributedata[$j] = $att[0].'-'.$att[1].'m';
									}else if($att[0]){
										$attributedata[$j] = $att[0].'m';
									}else{
										$attributedata[$j] = '';
									}
								}
							}
							

							$activeSheet->setCellValue('A'.$row, $i+1);
							$activeSheet->setCellValue('B'.$row, $data['name']);

							for ($z=0; $z < $m; $z++) { 
								for ($j=0; $j < count($attribute); $j++) { 
									if($attribute[$j] == $collength[$page][$z]){
										$activeSheet->setCellValue($zimu[$z].$row, $attributedata[$j]);
									}
								}
							}


							$activeSheet->setCellValue($zimu[$m].$row, ($data['count'].$data['unit']));
							$totalcount += $data['count'];
							for ($x=($m+1); $x < ($n+$m+1); $x++) {
								if($addressprices != 1 ){
									$activeSheet->setCellValue($zimu[$x].$row, round($addressdata[$Provinces[$x-$m-1]],1));
									$total_price[$page][$x-$m-1] += round($addressdata[$Provinces[$x-$m-1]]*$data['count']);
								}
							}

					}

					// var_dump($total_price[$page]);
					$activeSheet->setCellValue('A'.$endrow, '合计 : (装车价/元)');
					// 数量统计
					$activeSheet->setCellValue($zimu[$m].$endrow, '='.$totalcount);
					for ($i=0; $i < $n; $i++) { 
						if($addressprices != 1){
							$activeSheet->setCellValue($zimu[$i+$m+1].$endrow, '='.$total_price[$page][$i]);
						}else{
							$activeSheet->setCellValue($zimu[$i+$m+1].$endrow, '=""');
						}
					}

					$activeSheet->mergeCells('A'.$endrow.':'.$zimu[$m-1].$endrow);
					$activeSheet->getStyle('A'.$endrow)->getAlignment()
								->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
			}
		}
// 不同之处
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
			

	
// }





// Redirect output to a client’s web browser (Excel5)
$filename = $ordername.date("Ymd",time());
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