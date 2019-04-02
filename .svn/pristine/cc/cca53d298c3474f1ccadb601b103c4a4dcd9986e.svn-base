<?php 
require 'checkhost.php';
require 'db2.php';

// 获取参数
$userid = $_GET['uid'];
$data = $_GET['data'];
if (isset($data)) {
	!$userid && exit;
	$data = json_decode($data, true);

	$db = new db();

	$havekey = [];
	$i = 0;
	foreach ($data[0] as $key => $value) {
		$havekey[$i] = $key;
		$i++;
	}
	for ($j=0; $j < count($data); $j++) { 
		$dataj = $data[$j];
		$province_name = ['安徽','北京','重庆','福建','甘肃','广东','广西','贵州','海南','河北','河南','黑龙江','湖北','湖南','山东','吉林','江苏','江西','辽宁','内蒙古','宁夏','青海','山西','陕西','上海','四川','天津','新疆','云南','浙江'];

		$array_key = ['province1','province2','province3','province4','province5','province6','province7','province8','province9','province10','province11','province12','province13','province14','province15','province16','province17','province18','province19','province20','province21','province22','province23','province24','province25','province26','province27','province28','province29','province30'];
		$datas = '';
		foreach ($dataj as $key => $value) {
			for ($i=0; $i < count($province_name); $i++) { 
				if($province_name[$i] == $key){
					$datas .= $array_key[$i]."=".$value.",";
				}
			}
		}
		for ($i=0; $i < count($province_name); $i++) { 
			if(!in_array($province_name[$i], $havekey)){
				$datas .= $array_key[$i].'=0,';
			}
		}
		
		$datas = rtrim($datas, ",");

		$sql = 'update tree_order_temp set '.$datas.' where id='.$dataj['id'].'';
		$db->exec( $sql);
	}

	unset($db);
}
?>