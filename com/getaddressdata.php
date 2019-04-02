<?php
header("Content-Type: text/html; charset=UTF-8");
require 'db.php';
require '../PHPExcel/PHPExcel.php';
$db = new db();

// pingyuan,qianshan,lengliang,tongyong
// $type="落叶乔木";
// $type="落叶灌木";
// $type="落叶小乔木";
// $type="常绿灌木";
// $type="常绿乔木";
// $type="果树";
// $type="木质藤本";
// $type="宿根草本";
// $type="竹类";
// $type="草本";
// $type="藤本";
// $type="水生宿根草本";
// $type="滨水宿根草本";
// $type="常绿草本";
// $type="灌木";
// $type="宿根水生草本";
// $type="草质藤本";
// $type="二年生草本";
// $type="浮水草本";
// $type="多年生水生草本";
// $type="多年生沉水草本";
// $type="室内";
// $type="暂无";


$address = $_GET['name'];

$sql = 'select distinct(aliases_name) a,type,sum(count) b from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? group by a order by b desc';
$data = $db->prepare_query($sql,array($address));
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
// 居中 左偏 右偏
$activeSheet->getStyle('A:I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$activeSheet->setCellValue('D1', '落叶乔木');
$activeSheet->setCellValue('E1', '0至5.0');
$activeSheet->setCellValue('F1', '5.1至8.0');
$activeSheet->setCellValue('G1', '8.1至12.0');
$activeSheet->setCellValue('H1', '12.1至15.0');
$activeSheet->setCellValue('I1', '大于15');

$activeSheet->setCellValue('D2', '常绿乔木');
$activeSheet->setCellValue('E2', '0至1.0');
$activeSheet->setCellValue('F2', '1.1至2.0');
$activeSheet->setCellValue('G2', '2.1至4.0');
$activeSheet->setCellValue('H2', '4.1至8.0');
$activeSheet->setCellValue('I2', '大于8');

$activeSheet->setCellValue('D3', '落叶灌木');
$activeSheet->setCellValue('E3', '0至0.5');
$activeSheet->setCellValue('F3', '0.51至1.0');
$activeSheet->setCellValue('G3', '1.1至2.0');
$activeSheet->setCellValue('H3', '大于2');

$activeSheet->setCellValue('D4', '常绿灌木');
$activeSheet->setCellValue('E4', '0至0.5');
$activeSheet->setCellValue('F4', '0.51至1.0');
$activeSheet->setCellValue('G4', '1.1至2.0');
$activeSheet->setCellValue('H4', '大于2');

$activeSheet->setCellValue('A6', '序号');
$activeSheet->setCellValue('B6', '树种');
$activeSheet->setCellValue('C6', '数量');
$activeSheet->setCellValue('D6', '类别');
$activeSheet->setCellValue('E6', '');
$activeSheet->setCellValue('F6', '');
$activeSheet->setCellValue('G6', '');
$activeSheet->setCellValue('H6', '');
$activeSheet->setCellValue('I6', '');

for ($i=0; $i < $n; $i++) {
	$a = $data[$i];

	$activeSheet->setCellValue('A'.($i+7), (1+$i));
	$activeSheet->setCellValue('B'.($i+7), $a['a']);
	$activeSheet->setCellValue('C'.($i+7), $a['b']);
	$activeSheet->setCellValue('D'.($i+7), $a['type']);

	if($a['type'] == '落叶乔木'){
		$name = $a['a'];
		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.trunk_diameter is null) or (lmzm_tree.trunk_diameter <= 5))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('E'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('E'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.trunk_diameter > 5) and (lmzm_tree.trunk_diameter <= 8))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('F'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('F'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.trunk_diameter > 8) and (lmzm_tree.trunk_diameter <= 12))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0] != null){
			$activeSheet->setCellValue('G'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('G'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.trunk_diameter > 12) and (lmzm_tree.trunk_diameter <= 15))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('H'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('H'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and lmzm_tree.trunk_diameter > 15';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('I'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('I'.($i+7), '0');
		}
	}elseif($a['type'] == '常绿乔木'){
		$name = $a['a'];
		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.plant_height is null) or (lmzm_tree.plant_height <= 1))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('E'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('E'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.plant_height > 1) and (lmzm_tree.plant_height <= 2))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('F'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('F'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.plant_height > 2) and (lmzm_tree.plant_height <= 4))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0] != null){
			$activeSheet->setCellValue('G'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('G'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.plant_height > 4) and (lmzm_tree.plant_height <= 8))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('H'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('H'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and lmzm_tree.plant_height > 8';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('I'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('I'.($i+7), '0');
		}
	}elseif($a['type'] == '落叶灌木'){
		$name = $a['a'];
		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.plant_height is null) or (lmzm_tree.plant_height <= 0.5))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('E'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('E'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.plant_height > 0.5) and (lmzm_tree.plant_height <= 1))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('F'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('F'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.plant_height > 1) and (lmzm_tree.plant_height <= 2))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0] != null){
			$activeSheet->setCellValue('G'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('G'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and lmzm_tree.plant_height > 2';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0] != null){
			$activeSheet->setCellValue('H'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('H'.($i+7), '0');
		}
	}elseif($a['type'] == '常绿灌木'){
		$name = $a['a'];
		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.plant_height is null) or (lmzm_tree.plant_height <= 0.5))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('E'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('E'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.plant_height > 0.5) and (lmzm_tree.plant_height <= 1))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0]){
			$activeSheet->setCellValue('F'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('F'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and ((lmzm_tree.plant_height > 1) and (lmzm_tree.plant_height <= 2))';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0] != null){
			$activeSheet->setCellValue('G'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('G'.($i+7), '0');
		}

		$sql = 'select sum(lmzm_tree.count) a from lmzm_tree left join lmzm_user on lmzm_user.id = lmzm_tree.lmzm_user_id where lmzm_user.address=? and lmzm_tree.aliases_name=? and lmzm_tree.plant_height > 2';
		$result = $db->prepare_query($sql,array($address,$name));
		if($result[0] != null){
			$activeSheet->setCellValue('H'.($i+7), $result[0]['a']);
		}else{
			$activeSheet->setCellValue('H'.($i+7), '0');
		}
	}
}

//设置边框
$activeSheet->getStyle('A1:I'.($n+6))
			->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// 设置页面文字的方向和页面大小    锚：bbb
$activeSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup:: PAPERSIZE_A4);     //A4纸大小

// Redirect output to a client’s web browser (Excel5)
$filename = $address.'统计数据';
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



