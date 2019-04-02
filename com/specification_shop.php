
<?php
// 根据关键词 获取店内常用规格
require 'checkhost.php';
require 'db2.php';

$shopid = $_GET["shopid"];
$key = $_GET["key"];
$key = str_replace("蜡","腊",$key);
$key = str_replace("杆","干",$key);

$db = new db();

$sql = "select dbh,count(*) as c from tree where userid=? and state>0 and name like ? group by dbh order by c desc limit 8";
$dbhs = $db->prepare_query($sql,array($shopid, "%$key%"));

$sql = "select crownwidth,count(*) as c from tree where userid=? and state>0 and name like ? group by crownwidth order by c desc limit 8";
$crownwidths = $db->prepare_query($sql,array($shopid, "%$key%"));

$sql = "select height,count(*) as c from tree where userid=? and state>0 and name like ? group by height order by c desc limit 8";
$heights = $db->prepare_query($sql,array($shopid, "%$key%"));

$db = null;

$result = array();
foreach ($dbhs as $key => $dbh) {
	$result["dbh".($key+1)] = (float)$dbh[dbh];
}
foreach ($crownwidths as $key => $crownwidth) {
	$result["crownwidth".($key+1)] = (float)$crownwidth[crownwidth];
}
foreach ($heights as $key => $height) {
	$result["height".($key+1)] = (float)$height[height];
}

echo json_encode($result); 

?>