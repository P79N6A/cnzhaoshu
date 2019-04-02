<?php
define('PATH_IMAGE_ORIGINAL','../trees/yso/');
define('PATH_IMAGE_BIG','../trees/ysb/');
define('PATH_IMAGE_SMALL','../trees/yss/');
define('PATH_IMAGE_MOBIL','../trees/m/');

define('IMAGE_ORIGINAL_SIZE',1024);
define('IMAGE_BIG_SIZE',424);
define('IMAGE_SMALL_SIZE',200);
define('IMAGE_MOBIL_SIZE',70);

class tree {
	/**
	* 用户按步提交文字信息
	* 如果用户正在提交树木信息step(3-19), 20完成开始下一个
	* 0 重新提交姓名、手机号
	    3图片、4名称、
	    5胸径、6地经、7盆径、8冠幅、9株高、10条长、11主蔓长、12分枝点高、13分枝数、14主枝数
		17价格、18数量、19位置、20提交完成开始下一个
	*/
	public static function submitText($wechatid, $keyword, $step, $platformid) 
	{
		$db = new db();

		if (!is_numeric($keyword)) {
    		$keyword = str_replace("\n", '，', $keyword);
			$keyword = str_replace("'", "’", $keyword);
			$keyword = str_replace('"', "’", $keyword);
		}

		// if ($step<100) {
			switch ($step) {
				case 4:
					// 苗木名称, 不能用数字
					if (is_numeric($keyword)) {
						if ($keyword==1) {
							# 清地树
							$step = 27;
							$db->setTempTree($wechatid,++$step,'step=3,name=\'清地树\',ldname=NULL,pname=\'\',type=101,typename=\'\',unit=\'\',attribute=\'\',age=NULL,dbh=NULL,dbh_type=NULL,crownwidth=NULL,height=NULL,height_type=NULL,branch_point_height=NULL,branch_bough_number=NULL,substrate=NULL,remark=NULL');
						} else {
							$step = -4;
						}
					}else{
						$keyword = str_replace('，','-',$keyword);
						$keyword = str_replace('蜡','腊',$keyword);
						$keyword = str_replace('杆','干',$keyword);
						$keyword = str_replace('侩','桧',$keyword);
						$keyword = str_replace('快','桧',$keyword);
						$keyword = mb_substr($keyword, 0, 10, 'utf-8');		// 10位最长

						// 根据名称，从苗木字典获取属性、单位、分类代码，没有属性直接进入 价格
						$dictionary_tree = self::getDictionaryAttribute($keyword);
						$step = $dictionary_tree['attribute'] ? intval(explode(',',$dictionary_tree['attribute'])[0]) : 17;

						$db->setTempTree($wechatid,$step,'step=3,name=\''.$keyword.'\',ldname=\''.$dictionary_tree['ldname'].'\',pname=\'\',type='.$dictionary_tree['type'].',typename=\''.$dictionary_tree['typename'].'\',unit=\''.$dictionary_tree['unit'].'\',attribute=\''.$dictionary_tree['attribute'].'\',age=NULL,dbh=NULL,dbh_type=NULL,crownwidth=NULL,height=NULL,height_type=NULL,branch_point_height=NULL,branch_bough_number=NULL,substrate=NULL,remark=NULL');
					}
					break;
				case 5:
				case 6:
				case 7:
					// 5胸径，6地经，7盆径
					if (is_numeric($keyword)) {
						$keyword = $keyword*1;
						if ( $keyword>=0 && $keyword<=100) {
							// 获取下一步
							$nextstep = self::nextAttribute($wechatid, $step);
							$db->setTempTree($wechatid,$nextstep,'step=step+1,dbh_type='.$step.',dbh='.$keyword);
							$step = $nextstep;
						}else{
							$step = -$step;
						}					
					}else{
						$step = -$step;
					}				
					break;
				case 8:
					// 苗龄
					if (is_numeric($keyword)) {
						$keyword = $keyword*1;
						if ( $keyword>=0 && $keyword<=1000) {
							$nextstep = self::nextAttribute($wechatid, $step);
							$db->setTempTree($wechatid,$nextstep,'step=step+1,age='.$keyword);
							$step = $nextstep;
						}else{
							$step = -$step;
						}
					}else{
						$step = -$step;
					}								
					break;
				case 9:
				case 18:
					// 冠幅
					if (is_numeric($keyword)) {
						$keyword = $keyword*1;
						if ($step==18) $keyword=$keyword/100;
						if ( $keyword>=0 && $keyword<=20) {
							$nextstep = self::nextAttribute($wechatid, $step);
							$db->setTempTree($wechatid,$nextstep,'step=step+1,crownwidth='.$keyword);
							$step = $nextstep;
						}else{
							$step = -$step;
						}
					}else{
						$step = -$step;
					}								
					break;
				case 10:
				case 11:
				case 12:
				case 17:
					// 10株高、11条长、12主蔓长
					if (is_numeric($keyword)) {
						$keyword = $keyword*1;
						if ($step==17) $keyword=$keyword/100;
						if ( $keyword>=0 && $keyword<=20) {
							// 获取下一步
							$nextstep = self::nextAttribute($wechatid, $step);
							$db->setTempTree($wechatid,$nextstep,'step=step+1,height_type='.$step.',height='.$keyword);
							$step = $nextstep;
						}else{
							$step = -$step;
						}					
					}else{
						$step = -$step;
					}								
					break;
				case 13:
					// 分支点高,整数
					if (is_numeric($keyword)) {
						$keyword = $keyword*1;
						if ( $keyword>=0 && $keyword<=20 ) {
							// 获取下一步
							$nextstep = self::nextAttribute($wechatid, $step);
							$db->setTempTree($wechatid,$nextstep,'step=step+1,branch_point_height='.$keyword);
							$step = $nextstep;
						}else{
							$step = -$step;
						}					
					}else{
						$step = -$step;
					}								
					break;
				case 14:
				case 15:
					// 13分支数，14主支数，整数
					if (is_numeric($keyword)) {
						$keyword = $keyword*1;
						if ( $keyword>=0 && $keyword<=10 && is_int($keyword)) {
							// 获取下一步
							$nextstep = self::nextAttribute($wechatid, $step);
							$db->setTempTree($wechatid,$nextstep,'step=step+1,branch_bough_number='.$keyword);
							$step = $nextstep;
						}else{
							$step = -$step;
						}					
					}else{
						$step = -$step;
					}								
					break;
				case 16:
					// 品名
					$nextstep = self::nextAttribute($wechatid, $step);
					$step = $nextstep;

					if ($keyword=='0') {
						$db->setTempTree($wechatid,$nextstep,'step=step+1');
					} else {
						$keyword = mb_substr($keyword, 0, 10, 'utf-8');		// 10位最长
						$db->setTempTree($wechatid,$nextstep,'step=step+1,pname=\''.$keyword.'\'');

						// 有品名 加入字典
						$tree_attribute = self::getTemporaryTree($wechatid);
						$tree_attribute['attribute'] = str_replace('16,','',$tree_attribute['attribute']);
						$tree_attribute['name'] = $tree_attribute['pname'].$tree_attribute['name'];
						unset($tree_attribute['pname']);
						unset($tree_attribute['photogps']);

						require 'dictionary.attribute.class.php';
						attribute::update($tree_attribute);
					}
					
					break;
				case 19:
					// 基质
					$nextstep = self::nextAttribute($wechatid, $step);
					$step = $nextstep;

					if ($keyword=='0') {
						$db->setTempTree($wechatid,$nextstep,'step=step+1');
					} else {
						$keyword = mb_substr($keyword, 0, 10, 'utf-8');		// 10位最长
						$db->setTempTree($wechatid,$nextstep,'step=step+1,substrate=\''.$keyword.'\'');
					}
					
					break;
				case 25: // 备注
				case 28: // 清地说明					
					if ($keyword=='0') {
						$db->setTempTree($wechatid, ++$step, 'step=step+1');
					} else {
						$keyword = mb_substr($keyword, 0, 100, 'utf-8');		// 30位最长，清地树100
						$db->setTempTree($wechatid, ++$step, 'step=step+1,remark=\''.$keyword.'\'');
					}
					file_put_contents('t.txt', "$wechatid, $keyword\n");
					file_put_contents('t.txt', "$wechatid, ++$step, 'step=step+1,remark=\''.$keyword.'\''\n", FILE_APPEND);

					break;
				case 26:
					// 上车价格>0
					if (is_numeric($keyword)) {
						$keyword = $keyword*1;
						if ($keyword>0) {
							$db->setTempTree($wechatid, ++$step, 'step=step+1,price='.$keyword);
						}else{
							$step = -$step;
						}	
					}else{
						$step = -$step;
					}												
					break;
				case 27:
					// 数量,整数,>0&&<10万
					if (is_numeric($keyword)) {
						$keyword = $keyword*1;
						if (is_int($keyword) && $keyword>0 && $keyword<=100000) {
							$step++; // 跳过28清地说明
							$db->setTempTree($wechatid, ++$step, 'step=step+1,count='.$keyword);
						}else{
							$step = -$step;
						}					
					}else{
						$step = -$step;
					}																
					break;			
				case 29:
				//从5个常用位置里选择 位置 
					if (is_numeric($keyword) && ($keyword*1==1 || $keyword*1==2 || $keyword*1==3 || $keyword*1==4|| $keyword*1==5)) {
				        $keyword = $keyword*1;
				        
				        $usedAddress = user::getUsedAddress($wechatid);
				        $count = count($usedAddress);
				    

				        if ($keyword<=$count) {
					        // // 临时表转入正式表，返回treeid 
					        $treeids = tree::saveTree($wechatid, $platformid);
					        $treeid = $treeids['treeid'];

					        if ($treeid) {
						        $step = $treeids['qrcodeid'] ? $treeids['qrcodeid'] : $step+1;
						        
								$address = $usedAddress[$keyword-1];

								$value = 'x='.$address['x'].',y='.$address['y']
									.",province='".$address['province']
									."',city='".$address['city']
									."',district='".$address['district']
									."',address='".$address['address']."'";

								$db = new db();		
								$db->updateLocation($wechatid, $treeid, $value);
								$db->updateUsedAddress($address['id']);
								unset($db);
							}else{
								// 没有权限修改树牌，传回负数
								$step = -$treeids['qrcodeid'];
							}
						}else{
							$step = 0;
						}
					}else{
						$step = 0;
					}
					break;
				case 1:
				case 51:
					// 手机
					if ($keyword=='0') {
						$db->setUser($wechatid,++$step,'phone=phone');						
					} else {
						if (basic::isPhone($keyword)) {
							// 手机号码查重
							$users = $db->query('select userid,wechatid from user where phone=\''.$keyword.'\'');

							if ($users) {
								$isRepeat = true;
								
								foreach ($users as $user) {
									if ($user['wechatid']==$wechatid) {
										$isRepeat = false;
										break;
									}
								}
							}

							if ($isRepeat) {
								$step = -51;
							} else {
								$db->setUser($wechatid,++$step,'phone=\''.$keyword.'\'');
							}
						}else{
							$step = 0;
						}
					}
					break;
				case 2:
				case 52:
					// 名称
					if ($keyword=='0') {
						$db->setUser($wechatid,++$step,'name=name');						
					} else {
						if (is_numeric($keyword)) {
							$step = -52;
						} else {
							$keyword = mb_substr($keyword, 0, 20, 'utf-8');		// 20位最长
							$db->setUser($wechatid,++$step,'name=\''.$keyword.'\'');
							
							// 更新分店的shopname
							$user = $db->getUser('wechatid', $wechatid);
							$db->prepare_exec('update user set shopname=? where shopid=?', array($keyword, $user['userid']));
						}
					}
					break;
				case 53:
					// 公司简介
					if ($keyword=='0') {
						$db->setUser($wechatid,++$step,'introduction=introduction');						
					} else {
						$keyword = mb_substr($keyword, 0, 200, 'utf-8');		// 200位最长
						$db->setUserSafe($wechatid, ++$step, 'introduction', $keyword);
					}
					break;
				default:
					// 格式错误
					$step = 0;
					break;
			}
		// }else{
			// // 招标
			// switch ($step) {
			// 	case 31:
			// 		// 姓名
			// 		$keyword = mb_substr($keyword, 0, 21, 'utf-8');		// 21位最长
			// 		$db->setUser($wechatid,++$step,"name='".$keyword."'");
			// 		break;
			// 	case 32:
			// 		// 手机
			// 		if (basic::isPhone($keyword)) {
			// 			$keyword = basic::encode($keyword);

			// 			$db->setUser($wechatid,++$step,"phone='".$keyword."'");
			// 		}else{
			// 			$step = 0;
			// 		}
			// 		break;
			// 	case 33:
			// 		// 开始招标，输入招标内容
			// 		if (mb_strlen($keyword,'utf-8')<10) {
			// 			$step = -35;
			// 		}else{
			// 			$keyword = mb_substr($keyword, 0, 120, 'utf-8');		// 120位最长
			// 			$db->biddingUserNeeds($wechatid, $keyword);	
			// 			$db->setStep($wechatid, ++$step);			
			// 		}
			// 		break;
			// 	case 34:
			// 		// 确认是否发布招标，通知管理员审核
			// 		if ($keyword=='1') {
			// 			$bid = $db->biddingUserConfirm($wechatid);

			// 			include_once 'bidmessage.php';
			// 			$bidding = new bidding();
			// 			$bidding->sendAuditBidMessage($wechatid, $bid);
			// 			$bidding = null;

			// 		}else{
			// 			$db->biddingUserCancel($wechatid);
			// 			$step++;
			// 		}	

			// 		$db->stopSubmit($wechatid);
					
			// 		break;			
			// }			
		// }

		$db = null;
		return $step;
	}
	/**
	* 用户提交图片信息
	* -1不处理，>=3&&<=10下载图片,3下一步提示
	*/
	public static function submitImage($wechatid) 
	{
		$db = new db();
		$db->setStep($wechatid,4);
		$db = null;

		return 4;
	}

	/**
	* 用户按步提交位置信息，入库
	* －1 按坐标搜索, 0格式错误, 10通过map api获取省市县街道，入库，结束
	* step=3,马上开始新的
	*/
	public static function submitLocation($wechatid, $latitude, $longitude) 
	{
		$db = new db();
		$step = $db->getStep($wechatid);

		$step!=29 && $step>0 && $step = 0;

		$db = null;
		return $step;
	}

	/**
	* 保存苗木图片 到 临时表
	*/
	public static function saveImage($wechatid, $imgRawData, $isFirst, $msgid) 
	{
		$fname = strtolower(substr($wechatid, 25)).basic::getMillisecond();
		$filename = "$fname.jpg";
		
		// 存原始图片

		$result = basic::saveFile(PATH_IMAGE_ORIGINAL.$filename, $imgRawData); 
		if (!$result) return false;

		$image = imagecreatefromstring($imgRawData);
		unset($imgRawData);
		
		// 偶尔微信，exif_read_data错误，做容错处理
		try{
			$exif = exif_read_data(PATH_IMAGE_ORIGINAL.$filename, 0, true);			
			$orientation = $exif['IFD0']['Orientation'];
		}catch(Exception $e) {
			$exif = null;
		}

		if ($orientation) {
			switch($orientation) {
		        case 3:
		            $image = imagerotate($image, 180, 0);
		            break;
		        case 6:
		            $image = imagerotate($image, -90, 0);
		            break;
		        case 8:
		            $image = imagerotate($image, 90, 0);
		            break;
		    }
		}

		if (imagesx($image)>IMAGE_ORIGINAL_SIZE || imagesy($image)>IMAGE_ORIGINAL_SIZE) {
			$image = basic::resizeImage($image, IMAGE_ORIGINAL_SIZE, IMAGE_ORIGINAL_SIZE);
		}
		// 长边>IMAGE_ORIGINAL_SIZE的压缩
		imagejpeg($image, PATH_IMAGE_ORIGINAL.$filename, 80);
		
		include_once 'watermask.php';

		$phone = ' ';
		// 加水印
		new WaterMask(PATH_IMAGE_ORIGINAL.$filename, '../trees/o2/'.$filename, $phone, 50);


		// 存大图
		$big_image = basic::resizeImage($image, IMAGE_BIG_SIZE, IMAGE_BIG_SIZE);
		imagejpeg($big_image, PATH_IMAGE_BIG.$filename, 80);
		// 加水印
		new WaterMask(PATH_IMAGE_BIG.$filename, '../trees/b2/'.$filename, $phone, 30);
		// echo $filename;
		
		// 存小图
		$small_image = basic::resizeImage($image, IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE);
		imagejpeg($small_image, PATH_IMAGE_SMALL.$filename, 80);
		// 加水印
		new WaterMask(PATH_IMAGE_SMALL.$filename, '../trees/s2/'.$filename, $phone, 12);

		// 存手机缩略图
		$mobil_image = basic::resizeImage($small_image, IMAGE_MOBIL_SIZE, IMAGE_MOBIL_SIZE);
		imagejpeg($mobil_image, PATH_IMAGE_MOBIL.$filename, 80);

		imagedestroy($image);
		imagedestroy($big_image);
		imagedestroy($small_image);
		imagedestroy($mobil_image);

		// echo $filename;
		// 保存路径到临时表  imgpath=concat(imgpath,';test.jpg')
		$fname = basic::encode($fname);


		$sql = $isFirst ? "imgpath='$fname'" 
		      			: "imgpath=concat(imgpath,';$fname')";
		if ($exif && $exif['EXIF']['DateTimeOriginal'] && $exif['GPS']['GPSLatitude']) {
            include_once 'photogps.php';
            
            $photogps = PhotoGPS::qqGps($exif['GPS']);	

            if ($photogps) {
                $showorder = ',showorder=99';
				$phototime = $exif['EXIF']['DateTimeOriginal'];
            } else {
				$phototime = $photogps = $showorder = '';
            }  
		} else{
			$phototime = $photogps = $showorder = '';
		}

		$sql .= $isFirst ? "$showorder,phototime='$phototime',photogps='$photogps'" 
						 : "$showorder,phototime=concat(phototime,';$phototime'),photogps=concat(photogps,';$photogps')";

		$db = new db();
		$db->updateTempTree($wechatid, $sql);
		$db = null;

		return true;
	}

	/**
	* 保存苗木位置，省、市、区县 到正式表
	*/
	public static function saveLocation($wechatid, $treeid, $x, $y, $location) 
	{
		$address = $location['formatted_addresses']['recommend'];


		$addressComponent = $location['address_component'];
		
		$province = $addressComponent['province'];
		$province = str_replace('省','',$province);
		$province = str_replace('市','',$province);
		$province = str_replace('自治区','',$province);
		$province = str_replace('壮族','',$province);
		$province = str_replace('维吾尔','',$province);
		$province = str_replace('回族','',$province);
		
		$city = $addressComponent['city'];
		if (mb_strlen($city,'utf-8')>2) {
			$city = str_replace('市','',$city);
			$city = str_replace('盟','',$city);
			$city = str_replace('自治州','',$city);
			$city = str_replace('地区','',$city);
			$city = str_replace('回族','',$city);
			$city = str_replace('藏族','',$city);
			$city = str_replace('蒙古','',$city);
			$city = str_replace('哈萨克','',$city);
			$city = str_replace('朝鲜族','',$city);
			$city = str_replace('彝族','',$city);
			$city = str_replace('羌族','',$city);
			$city = str_replace('土家族','',$city);
			$city = str_replace('苗族','',$city);
			$city = str_replace('侗族','',$city);
			$city = str_replace('布依族','',$city);



		}

		$district = $addressComponent['district'];
		// 新市区 不处理
		if (mb_strlen($district,'utf-8')>2 && strpos($district,'市区')===false) {
			$district = str_replace('市','',$district);
			$district = str_replace('自治区','',$district);
			$district = str_replace('自治县','',$district);
			$district = str_replace('新区','',$district);
			$district = str_replace('区','',$district);
			$district = str_replace('县','',$district);
			$district = str_replace('满族','',$district);
			$district = str_replace('蒙古族','',$district);
			$district = str_replace('彝族','',$district);
			$district = str_replace('土家族','',$district);
			$district = str_replace('回族','',$district);
			$district = str_replace('土族','',$district);
		}else{
			if (empty($district)) {
				$district = $city;
			}
		}

		$value = "x=$x,y=$y,province='$province',city='$city',district='$district',address='$address'";

		$db = new db();		
		$db->updateLocation($wechatid, $treeid, $value);
		$db = null;

		$db = new db();
		$usedAddressList = $db->getUsedAddress($wechatid);
		
        $count = count($usedAddressList);
        $isInclude = false;
        $x = (float)$x; $y = (float)$y;

        for ($i=0; $i < $count; $i++) { 
            $useraddress = $usedAddressList[$i];
            // if ($address['province']==$province && $address['district']==$district) {
            // 用3位坐标来判断
            if ( (abs($useraddress['x']-$x)<0.002 && abs($useraddress['y']-$y)<0.003) 
            	|| ($useraddress['address']==$address) ) {
            	$isInclude = true;
            	$db->updateUsedAddress($useraddress['id']);
            	break;
            }
        }


        if (!$isInclude) {
        	$db->setUsedAddress($wechatid, $value);
        }
		
		$db = null;
	}

	/**
	* 保存苗木 到正式表，返回treeid
	*/
	public static function saveTree($wechatid, $platformid) 
	{
		$db = new db();

		// 清理phototime、photogps = ''、';'、';;'
		$db->exec('update treetemp set phototime=NULL,photogps=NULL,showorder=0 where wechatid=\''.$wechatid.'\' and LENGTH(phototime)<10');
		
		// 检查二维码
		$temptree = $db->query('select * from v_treetemp where wechatid=\''.$wechatid.'\'')[0];

		$imgpaths = split('\;',$temptree['imgpath']);
		foreach ($imgpaths as $imgpath){
            $imgpath = PATH_IMAGE_ORIGINAL.basic::decode($imgpath).'.jpg';

			$image = new ZBarCodeImage($imgpath);	// 新建一个图像对象
			$scanner = new ZBarCodeScanner(); // 创建一个二维码识别器  
			$barcode = $scanner->scan($image);//识别图像  

			if (!empty($barcode)){
				$qrcode = $barcode[0]['data'];
				$params = split('ID=', $qrcode);
				if (count($params)==2 && is_numeric($params[1])) {
					$qrcodeid = $params[1];
					break;
				}
			}
		}

		if ($qrcodeid){
			$qrcodetree = $db->query('select treeid,userid from tree where qrcodeid='.$qrcodeid)[0];
			if ($qrcodetree) {
				// 二维码 已经用过，检查用户权限
				if ($temptree['userid']==$qrcodetree['userid'] || $temptree['userstate']>5) {
					// 树主 或者 是 认证人员 覆盖旧的
					$db->updateTreeFromTreeTemp($wechatid, $qrcodeid, $temptree);
					$treeid = $qrcodetree['treeid'];
				}else{
					// 非树主或非认证人员，不能修改，停止上传
					$db->stopSubmit($wechatid);
					$treeid = null;
				}
			}else{
				$treeid = $db->insertTreeFromTreeTemp($wechatid, $qrcodeid, $temptree['userid'], $platformid);
			}
		}else{
			$treeid = $db->insertTreeFromTreeTemp($wechatid, $qrcodeid, $temptree['userid'], $platformid);
		}

		// 清理临时表照片信息
	    $db->exec('update treetemp set video=NULL, phototime=NULL,photogps=NULL,showorder=0 where wechatid=\''.$wechatid.'\'');
	    unset($db);

		return array('treeid'=>$treeid,'qrcodeid'=>$qrcodeid);
	}

	/**
	* 删除树苗,1101010020089
	*/
	public static function delete($treeid) 
	{
		$db = new db();
		if (strlen($treeid)==13) {
			$result = $db->query('select treeid from tree where qrcodeid='.$treeid);
			if ($result) {
				$treeid = $result[0]['treeid'];
			}
		}

		$result = $db->deleteTree($treeid);
		$db = null;
		return $result ? 'd0' : 'd1';	//d0删除成功， d1 删除失败，请重试！
	}
	public static function getTemporaryTree($wechatid)
	{
		$db = new db();
		$result = $db->prepare_query('select name,ldname,pname,type,typename,unit,attribute,phototime,photogps from treetemp where wechatid=?',array($wechatid));
		unset($db);

		return $result[0];	
	}

	/**
	* 获取正在上传的同规格的树的价格范围
	*/
	function getPriceRange($wechatid)
	{
	    $db = new db();
	    $result = $db->query('SELECT avg(a.price) as avg,max(a.price) as max,min(a.price) as min FROM tree as a, treetemp as b WHERE b.wechatid=\''.$wechatid.'\' and a.name=b.name and a.dbh=b.dbh and a.crownwidth=b.crownwidth and a.height=b.height');
	    unset($db);

		return $result && $result[0]['min'] 
				? $result[0]['min'].'-'.$result[0]['max'].' 均价'.round($result[0]['avg'],2)
				: ' ';
	}

	// 
	public static function save_temp_video($filename, $wechatid)
	{
		$db = new db();
		$db->exec("update treetemp set video='$filename' where wechatid='$wechatid';update treetemp set showorder=98 where wechatid='$wechatid' and showorder<98");
		unset($db);
	}

	// 根据名称从苗木字典获取属性、单位
	public static function getDictionaryAttribute($name)
	{
		$db = new db();
		$sql = 'select ldname,type,typename,unit,attribute from dictionary_attribute where name=?';
		$result = $db->prepare_query( $sql, array( $name ) );
		
		if (!$result) {
			// 字典里没有的，入库补充，默认属性：胸径，冠幅，树高
			$sql = 'insert ignore into dictionary_none set name=?';
			$db->prepare_exec( $sql, array( $name ) );

			$result = array('ldname'=>'','type'=>100,'typename'=>'','unit'=>'株','attribute'=>'5,9,10'); 
		} else {
			$result = $result[0];
		}

		unset($db);	

		return 	$result;
	}

	// 根据当前树的当前属性，获取下一个属性
	public static function nextAttribute($wechatid, $attribute_id)
	{
		$db = new db();
		$sql = 'select attribute from treetemp where wechatid=?';
		$result = $db->prepare_query( $sql, array( $wechatid ) );
		unset($db);

		$attributes = explode(',', $result[0]['attribute']);
		$index = array_search($attribute_id, $attributes);

		// 下一个属性，如果是最后一个，则跳入价格步骤
		return $index<count($attributes)-1 ? intval($attributes[$index+1]) : 25;
	}
}

?>