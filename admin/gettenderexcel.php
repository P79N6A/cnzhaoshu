<?php
header("Content-Type: text/html; charset=UTF-8");

//生成投标的EXCEL
set_time_limit(0);
require './PHPExcel/Classes/PHPExcel.php';

require '../com/db.php';

$project_id = isset($_GET['project_id']) ? $_GET['project_id'] : "";

$db = new db();
//发标树木
$sql = "select tree_order_id,tree_seq_num,project,tree_name,plant_height,dbh,ground_diameter,crown,remarks,company,tree_num,price,basin_diameter,seedling_age,strip_length,main_tendril_length,high_branch_point,branch_number,main_branch_number,product_name,stroma,tree_age,long_branch_point from new_tree_order where project=?";

$datas = $db->prepare_query($sql, array($project_id));

$project_name_sql = "select project_name from order_project where project_id=?";

$project_name = $db->prepare_query($project_name_sql, array($project_id))[0];

$ordername = $project_name['project_name'];

for ($i = 0; $i < count($datas); $i++) {

    $data = $datas[$i];

    $attribute = '';

    if ($data['dbh']) {

        $trunk_diameter = explode(',', $data['dbh']);

        if (count($trunk_diameter) > 1) {

            $attribute .= '胸径' . $trunk_diameter[0] . '-' . $trunk_diameter[1] . 'cm，';

        } else if ($trunk_diameter[0]) {

            $attribute .= '胸径' . $trunk_diameter[0] . 'cm，';

        }

    }

    if ($data['ground_diameter']) {

        $ground_diameter = explode(',', $data['ground_diameter']);

        if (count($ground_diameter) > 1) {

            $attribute .= '地径' . $ground_diameter[0] . '-' . $ground_diameter[1] . 'cm，';

        } else if ($ground_diameter[0]) {

            $attribute .= '地径' . $ground_diameter[0] . 'cm，';

        }

    }

    if ($data['basin_diameter']) {

        $pot_diameter = explode(',', $data['basin_diameter']);

        if (count($pot_diameter) > 1) {

            $attribute .= '盆径' . $pot_diameter[0] . '-' . $pot_diameter[1] . 'cm，';

        } else if ($pot_diameter[0]) {

            $attribute .= '盆径' . $pot_diameter[0] . 'cm，';

        }

    }

    if ($data['basin_diameter']) {

        $attribute .= '苗龄' . $data['basin_diameter'][0] . '年，';

    }

    if ($data['plant_height']) {

        $plant_height = explode(',', $data['plant_height']);

        if (count($plant_height) > 1) {

            $attribute .= '株高' . ((float)$plant_height[0] * 100) . '-' . ((float)$plant_height[1] * 100) . 'cm，';

        } else if ($plant_height[0]) {

            $attribute .= '株高' . ((float)$plant_height[0] * 100) . 'cm，';

        }

    }

    if ($data['crown']) {

        $crown = explode(',', $data['crown']);

        if (count($crown) > 1) {

            $attribute .= '冠幅' . ((float)$crown[0] * 100) . '-' . ((float)$crown[1] * 100) . 'cm，';

        } else if ($crown[0]) {

            $attribute .= '冠幅' . ((float)$crown[0] * 100) . 'cm，';

        }
    }

    if ($data['long_branch_point']) {

        $branch_length = explode(',', $data['long_branch_point']);

        if (count($branch_length) > 1) {

            $attribute .= '分枝长' . ((float)$branch_length[0] * 100) . '-' . ((float)$branch_length[1] * 100) . 'cm，';

        } else if ($branch_length[0]) {

            $attribute .= '分枝长' . ((float)$branch_length[0] * 100) . 'cm，';

        }

    }

    if ($data['main_tendril_length']) {

        $bough_length = explode(',', $data['main_tendril_length']);

        if (count($bough_length) > 1) {

            $attribute .= '主枝长' . ((float)$bough_length[0] * 100) . '-' . ((float)$bough_length[1] * 100) . 'cm，';

        } else if ($bough_length[0]) {

            $attribute .= '主枝长' . ((float)$bough_length[0] * 100) . 'cm，';

        }

    }

    if ($data['high_branch_point']) {

        $branch_point_height = explode(',', $data['high_branch_point']);

        if (count($branch_point_height) > 1) {

            $attribute .= '分枝点高' . ((float)$branch_point_height[0] * 100) . '-' . ((float)$branch_point_height[1] * 100) . 'cm，';

        } else if ($branch_point_height[0]) {

            $attribute .= '分枝点高' . ((float)$branch_point_height[0] * 100) . 'cm，';

        }

    }

    if ($data['branch_number']) {

        $branch_number = explode(',', $data['branch_number']);

        if (count($branch_number) > 1) {

            $attribute .= '分枝数' . $branch_number[0] . '-' . $branch_number[1] . '个，';

        } else if ($branch_number[0]) {

            $attribute .= '分枝数' . $branch_number[0] . '个，';

        }

    }

    if ($data['main_branch_number']) {

        $bough_number = explode(',', $data['main_branch_number']);

        if (count($bough_number) > 1) {

            $attribute .= '主枝数' . $bough_number[0] . '-' . $bough_number[1] . '个，';

        } else if ($bough_number[0]) {

            $attribute .= '主枝数' . $bough_number[0] . '个，';

        }

    }

    if ($data['stroma']) {

        $attribute .= '基质:' . $data['stroma'] . '，';

    }

    if ($data['remarks']) {

        $attribute .= '备注:' . $data['remarks'] . '，';

    }

    $attribute = rtrim($attribute, "，");

    $datas[$i]['attribute'] = $attribute;

    $user_info_sql = "select a.tender_tree_id,a.tender_status,a.tree_num,a.tree_address,a.tree_price,b.name,b.phone,a.remarks from (select * from tender_order where tender_tree_id = '" . $datas[$i]['tree_order_id'] . "') a left join (select name,phone,userid from user) b on a.tender_user_id = b.userid";

    $datas[$i]['user_info'] = $db->query($user_info_sql);
}

$objPHPExcel = new PHPExcel();

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
    ->mergeCells('A1:F1')
    ->setCellValue('A1', $ordername)
    ->getStyle('A1')->getFont()->setSize(24);

$activeSheet->getStyle('A1')->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$activeSheet->getRowDimension('1')->setRowHeight(50);

$activeSheet->getColumnDimension('A')->setWidth(10);

$activeSheet->getColumnDimension('B')->setWidth(40);

$activeSheet->getColumnDimension('C')->setWidth(20);

$activeSheet->getColumnDimension('D')->setWidth(15);

$activeSheet->getColumnDimension('E')->setWidth(15);

$activeSheet->getColumnDimension('F')->setWidth(100);

$activeSheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$activeSheet->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

$activeSheet->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$activeSheet->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$activeSheet->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$activeSheet->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$activeSheet->setCellValue('A2', '序号')
    ->setCellValue('B2', '姓名')
    ->setCellValue('C2', '联系方式')
    ->setCellValue('D2', '')
    ->setCellValue('E2', '上车价格')
    ->setCellValue('F2', '备注');

$row = 2;

foreach ($datas as $key => $val) {

    $row++;
    $activeSheet->setCellValue('A' . $row, ($key + 1));

    $activeSheet->setCellValue('B' . $row, " " . $val['tree_seq_num']);

    $activeSheet->setCellValue('C' . $row, " " . $val['tree_name']);

    $activeSheet->setCellValue('D' . $row, " " . $val['company']);

    $activeSheet->setCellValue('E' . $row, " " . $val['price']);

    $activeSheet->setCellValue('F' . $row, " " . $val['attribute'] . $val['remarks']);

    $biddatacount = count($val['user_info']);
    for ($j = 0; $j < $biddatacount; $j++) {

        $bid_data = $val['user_info'][$j];
        if ($bid_data['tender_status'] == 2) {

            $bid_data['tender_tui'] = "推荐";

        } else {

            $bid_data['tender_tui'] = "不推荐 :";

        };
        if(!empty($bid_data)){

            if($val['tree_order_id'] == $bid_data['tender_tree_id']){

                $row++;

                $activeSheet->setCellValue('B'.$row, wxNickNameFormat($bid_data['name']));

                $activeSheet->setCellValue('C'.$row, $bid_data['phone']);

                $activeSheet->setCellValue('D'.$row, $bid_data['tree_num']);

                $activeSheet->setCellValue('E'.$row, $bid_data['tree_price']);

                $activeSheet->setCellValue('F'.$row, $bid_data['tree_address']."(".$bid_data['tender_tui'].$bid_data['remarks'].")");

			}
        }
    }
}

//设置边框
$activeSheet->getStyle('A2:F' . $row)
    ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$activeSheet->getStyle('A2:F' . $row)
    ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$activeSheet->getStyle('A2:F' . $row)
    ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$activeSheet->getStyle('A2:F' . $row)
    ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$activeSheet->getStyle('A2:F' . $row)
    ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$activeSheet->getStyle('A2:F' . $row)
    ->getBorders()->getHorizontal()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// 设置页面文字的方向和页面大小    锚：bbb
$activeSheet->getPageSetup()
    ->setPaperSize(PHPExcel_Worksheet_PageSetup:: PAPERSIZE_A4);     //A4纸大小

// Redirect output to a client’s web browser (Excel5)
$filename = $ordername . date('YmdHis', time());

if (strpos($_SERVER["HTTP_USER_AGENT"], "Windows")) $filename = urlencode($filename);

header('Content-Type: application/vnd.ms-excel');

header('Content-Disposition: attachment;filename="' . $filename . '.xls"');

header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past

header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified

header('Cache-Control: cache, must-revalidate'); // HTTP/1.1

header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$objWriter->save('php://output');
exit;


function wxNickNameFormat($nickName){
    $value = json_encode($nickName);
    $value = preg_replace("/\\\u[ed][0-9a-f]{3}\\\u[ed][0-9a-f]{3}/","*",$value);
    return json_decode($value);
}
