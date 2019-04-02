<?php

	require 'db2.php';
	require '../PHPExcel/PHPExcel.php';
	
	$file = $_FILES['file'];
	header("Content-type:text/html;charset=utf-8");

	$db = new db();
	$PHPReader = new PHPExcel_Reader_Excel2007(); 

	         
	function get_total_millisecond(){  
	    $date = date('ymdHis',time());;
	    $time = explode (" ", microtime () );   
	    $time = 1000 + (int)($time [0] * 1000);
	    $rand = rand(1001,9999);
	    return ($date . $time . $rand); 
	}

	$zipname = get_total_millisecond().'.zip';
	$zipPath='../zipexcel/'.$zipname;
	move_uploaded_file($file['tmp_name'],$zipPath);
	
	function get_zip_originalsize($filename, $path,$db,$PHPReader) {

		$order = ['B','C','D','E','F','G','H','I','J'];
		$attribute = ['tree_name','trunk_diameter','ground_diameter','crown','plant_height','branch_point_height','ball','count','price'];
		$waringstr = '';
		$dictionary = $db->query('select * from dictionary_attribute order by CONVERT(name USING gbk)');
		$q = count($dictionary);
		//先判断待解压的文件是否存在
		if(!file_exists($filename)){
			die("文件 $filename 不存在！");
		} 
		$starttime = explode(' ',microtime()); //解压开始的时间

		//将文件名和路径转成windows系统默认的gb2312编码，否则将会读取不到
		$filename = iconv("utf-8","gb2312",$filename);
		$path = iconv("utf-8","gb2312",$path);
		//打开压缩包
		$resource = zip_open($filename);
		//遍历读取压缩包里面的一个个文件
		while ($dir_resource = zip_read($resource)) {
			//如果能打开则继续
			if (zip_entry_open($resource,$dir_resource)) {
				//获取当前项目的名称,即压缩包里面当前对应的文件名
				$file_name = $path.zip_entry_name($dir_resource);
				//以最后一个“/”分割,再用字符串截取出路径部分
				$file_path = substr($file_name,0,strrpos($file_name, "/"));
	
				//如果路径不存在，则创建一个目录，true表示可以创建多级目录
				if(!is_dir($file_path)){
					mkdir($file_path,0777,true);
				}
				//如果不是目录，则写入文件
				if(!is_dir($file_name)){
					//读取这个文件
					$file_size = zip_entry_filesize($dir_resource);
					//解压
					$file_content = zip_entry_read($dir_resource,$file_size);
					$excelname = get_total_millisecond();
					$excelname_path = '../lmzm_excel/'.$excelname.'.xlsx';
					file_put_contents($excelname_path,$file_content);

					$sheet=0;

					if(!$PHPReader->canRead($excelname_path)){
					        $PHPReader = new PHPExcel_Reader_Excel5();
					        if(!$PHPReader->canRead($excelname_path)){
				                	$excelnames = mb_convert_encoding($file_name, "UTF-8", "GBK");
				                	$excelnames = explode(' ', $excelnames)[0];
				                	$excelnames = explode('/', $excelnames)[3];
				                    $waringstr .= $excelnames.'表不是excel; ';
				                    continue;
					        }
					}

						$PHPExcel = $PHPReader->load($excelname_path);        //建立excel对象
						$currentSheet = $PHPExcel->getSheet($sheet);        //**读取excel文件中的指定工作表*/
						$allColumn = $currentSheet->getHighestColumn();        //**取得最大的列号*/
						$allRow = $currentSheet->getHighestRow();        //**取得一共有多少行*/
						$data = array();
						for($rowIndex=1;$rowIndex<=$allRow;$rowIndex++){        //循环读取每个单元格的内容。注意行从1开始，列从A开始
					        for($colIndex='A';$colIndex<='J';$colIndex++){
				                $addr = $colIndex.$rowIndex;
				                $cell = $currentSheet->getCell($addr)->getValue();
				                if($cell instanceof PHPExcel_RichText){ //富文本转换字符串
			                        $cell = $cell->__toString();
				                }
				                $data[$rowIndex][$colIndex] = $cell;
					        }
						}
						$companyname = $data[3]['C'] ? $data[3]['C'] : $data[3]['D'];
						$companyarea = $data[3]['I'];
						$companyarea = floatval($companyarea);
						$companyusername = $data[4]['C'] ? $data[4]['C'] : $data[4]['D'];
						$companyphone = $data[4]['I'];
						$companyaddress = $data[5]['C'] ? $data[5]['C'] : $data[5]['D'];

						$sql = 'insert into lmzm_user(company_name,area,user_name,phone,excel,address) values(?,?,?,?,?,?)';
						$lmzm_userid = $db->prepare_insert($sql,array($companyname,$companyarea,$companyusername,$companyphone,$excelname,$companyaddress));
						if($lmzm_userid){
							$datas = array();
							$n = 0;
							for ($i=7; $i <= count($data); $i++) { 
							    $onedata = $data[$i];
							    foreach ($onedata as $key => $value) {
							        if($value){
							            for ($j=0; $j < count($order); $j++) { 
							                if($key == $order[$j]){
							                    $datas[$n][$attribute[$j]] = $value;
							                }
							            }
							        }
							    }
							    ++$n; 
							}
							$date = array();
							for ($i=0; $i < count($datas); $i++) { 
							    if($datas[$i]){
							        array_push($date, $datas[$i]);
							    }
							}
							$datas = $date;
							if($datas){
							    for ($i=0; $i < count($datas); $i++) { 
							        $keydatas = array();
							        $nkeydatas = array();
							        $valuedatas = array();
							        foreach ($datas[$i] as $key => $value) {
							        	$value = trim($value," ");
							        	if($key == 'tree_name'){
							        		$has = false;
							        		for ($j=0; $j < $q; $j++) { 
							        		    if($dictionary[$j]['name'] == $value){
							        		        array_push($keydatas, 'type');
							        		        array_push($nkeydatas, '?');
							        		        array_push($valuedatas, $dictionary[$j]['type']);
							        		        $has = true;
							        		    }
							        		}
							        		if(!$has){
							        		    array_push($keydatas, 'type');
							        		    array_push($nkeydatas, '?');
							        		    array_push($valuedatas, 11);
							        		}
							        	}else{
							        		$value = floatval($value);
							        	}
							            if($key != 'price'){
							                array_push($keydatas, $key);
							                array_push($nkeydatas, '?');
							                array_push($valuedatas, $value);
							            }else{
							                array_push($keydatas, $key);
							                array_push($nkeydatas, '?');
							                array_push($valuedatas, $value*100);
							            }
							        }
							        array_push($keydatas, 'lmzm_user_id');
							        array_push($nkeydatas, '?');
							        array_push($valuedatas, $lmzm_userid);
							        $sql = 'insert into lmzm_tree('.join(',',$keydatas).') values('.join(',',$nkeydatas).')';

							        $result = $db->prepare_insert($sql,$valuedatas);
							    }

							}
						}  

				}
				//关闭当前
				zip_entry_close($dir_resource);
			}
		}
		//关闭压缩包
		zip_close($resource); 
		return $waringstr ? $waringstr : 1;
	}

	echo get_zip_originalsize($zipPath,'../zipexcel/',$db,$PHPReader);
unset($db);
unset($PHPReader);
