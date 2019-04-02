<?php
// 统计关键词搜索频次
require '../com/db.php';

$db = new db();
// dbh
$sql = "select word,dbh,sum(c)as cc from (select word, dbh,count(dbh)as c from keyword where word is not null and dbh>0 group by word,dbh union all select word, dbh,count(dbh)as c from keyword2 where word is not null and dbh>0 group by word,dbh) alias group by word,dbh order by word,cc desc";
$result = $db->query($sql);	
$count = count($result);

$word = '';
$set = '';
$j = 1;
for ($i=0; $i < $count; $i++) { 
	$r = $result[$i];
	if ($word==$r[word]) {
		if ($j<=8) {
			$set .= ",dbh$j=$r[dbh]";
			$j++;
		}
	}else{
		if ($word != '') {
			$set = substr($set,1);

			$sql = "update keycount set $set where word='$word'";	
			$db->exec($sql);
			// echo "$i: $sql<br>";		
		}

		$word = $r[word];
		$set = ",dbh1=$r[dbh]";
		$j = 2;
	}
}
// 
// crownwidth
$sql = "select word,crownwidth,sum(c)as cc from (select word,crownwidth,count(crownwidth)as c from keyword where word is not null and crownwidth>0 group by word,crownwidth union all select word,crownwidth,count(crownwidth)as c from keyword2 where word is not null and crownwidth>0 group by word,crownwidth) alias group by word,crownwidth order by word,cc desc";
$result = $db->query($sql);	
$count = count($result);
// echo "$count";
// 
$word = '';
$set = '';
$j = 1;
for ($i=0; $i < $count; $i++) { 
	$r = $result[$i];
	if ($word==$r[word]) {
		if ($j<=8) {
			$set .= ",crownwidth$j=$r[crownwidth]";
			$j++;
		}
	}else{
		if ($word != '') {
			$set = substr($set,1);

			$sql = "update keycount set $set where word='$word'";	
			$db->exec($sql);
			// echo "$i: $sql<br>";		
		}

		$word = $r[word];
		$set = ",crownwidth1=$r[crownwidth]";
		$j = 2;
	}
}
// 
// // height
$sql = "select word,height,sum(c)as cc from (select word,height,count(height)as c from keyword where word is not null and height>0 group by word,height union all select word,height,count(height)as c from keyword2 where word is not null and height>0 group by word,height) alias group by word,height order by word,cc desc";
$result = $db->query($sql);	
$count = count($result);
// echo "$count";
// 
$word = '';
$set = '';
$j = 1;
for ($i=0; $i < $count; $i++) { 
	$r = $result[$i];
	if ($word==$r[word]) {
		if ($j<=8) {
			$set .= ",height$j=$r[height]";
			$j++;
		}
	}else{
		if ($word != '') {
			$set = substr($set,1);

			$sql = "update keycount set $set where word='$word'";	
			$db->exec($sql);
			// echo "$i: $sql<br>";		
		}

		$word = $r[word];
		$set = ",height1=$r[height]";
		$j = 2;
	}
}

$db = null;

echo "$i: $sql<br>";
?>