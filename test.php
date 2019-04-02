<?php

$user = 'tt';
echo $user || 'no user';
echo $user ? $user : 'no user';

// function my_dir($dir) {
//     $files = array();
//     if(@$handle = opendir($dir)) { //注意这里要加一个@，不然会有warning错误提示：）
//         while(($file = readdir($handle)) !== false) {
//             if($file != ".." && $file != "." && $file != "PHPExcel" && $file != "phpmyadmin" 
//               && $file != "phpqrcode" && $file != "zipexcel" && $file != "ThinkPHP"  && $file != "ThinkPHP") { //排除根目录；
//                 if(is_dir($dir."/".$file)) { //如果是子文件夹，就进行递归
//                     $files[$file] = my_dir($dir."/".$file);
//                 } else { //不然就将文件的名字存入数组；
//                     $files[] = $file;
//                 }
 
//             }
//         }
//         closedir($handle);
//         return $files;
//     }
// }
// echo "<pre>";
// print_r(my_dir("."));
// echo "</pre>";


// $a1 = array(1,2,3,4,5,8);
// $a2 = array(2,3,4,5);
// $array_sum = array_merge($a1, $a2);


// echo json_encode($array_sum);


// $sum = array_sum($array_sum);

// echo $sum/count($array_sum);


// require 'com/db.php';

// $db = new db();
// $sql = 'select * from tree_order';
// echo $sql;
// $orders = $db->query('select * from tree_order');

// foreach ($orders as $key => $order) {
//   // echo json_encode($order);
//   // $crown = $order['crown'];


//   // $plant_height = $order['plant_height'];
//   // if (condition) {
//   //   # code...
//   // }

//   echo $order['orderid'].'<br>';
//   echo $order['plant_height'].'-'.(int)$order['plant_height'].'<br>';

// }


 

// // unset($db);

// // $str = '九十';
// // $key = '4公分1的五角枫';

// // $value = preg_replace("/[^0-9.-]/", '', $key);
// // echo $value;

// //补充一个中文转数字的
// function cn_2_num($string){
//   $convert_cn = array("〇","一","二","三","四","五","六","七","八","九","十");

//   if (strpos($string,'公分')!==false) {
//     $str = explode('公分', $string)[0];
//   } else if (strpos($string,'厘米')!==false) {
//     $str = explode('厘米', $string)[0];    
//   } else if (strpos($string,'米')!==false) {
//     $str = explode('米', $string)[0];    
//   } else if (strpos($string,'的')!==false) {
//     $str = explode('的', $string)[0];    
//   } else {
//     $str = $string;
//   }

//   $str = str_replace('零', '〇', $str);

//   $len = mb_strlen($str,'utf-8');
//   $num = 0;
//   $k = '';
//   $num_cn = '';

//   for($i=0;$i<$len;$i++) {
//     $cn = mb_substr($str,$i,1,'utf-8');
//     if($cn == '十') {
//       $num = $num + ($k ? intval($k)*10 : 10);
//       $k = '';
//       $num_cn .= $cn;
//     } else {
//       $key = array_search($cn,$convert_cn);
//       if ($key!==false) {
//         $k .= $key; 
//         $num_cn .= $cn;
//       }
//     }
//   }

//   if($k) {
//     $num = $num + intval($k);
//   } 
//   return $num_cn ? str_replace($num_cn, $num, $string) : $string;// $num;                                                            
// }        

// echo cn_2_num('十五公分国槐');


// function decompositionKey($key) {
//   $key = str_replace('－','-',$key);
//   $key = str_replace('至','-',$key);
//   if (strpos($key,'-')!==false) {
//       $key = explode('-', $key);
//       $key = cn_2_num($key[0]).'-'.cn_2_num($key[1]);
//   } else {
//       $key = cn_2_num($key);
//   }
//   $key = str_replace('h','',$key);
//   $key = str_replace('_','',$key);
//   $key = str_replace('的','',$key);

//   $value = preg_replace("/[^0-9.-]/", '', $key); 

//   if ($value) {
//     if ( strlen($value)>=3 && strpos($value,'.')===false && strpos($value,'-')===false ) {
//         return '"key":"'.$key.'"';
//     }

//     $isHeight = false;
//     $key = str_replace($value,'',$key);
//     $key = strtolower($key);

//     if (strpos($key,'公分')!==false) {
//       $key = str_replace('公分','',$key);
//     } else if (strpos($key,'厘米')!==false) {
//       $key = str_replace('厘米','',$key);
//     } else if (strpos($key,'cm')!==false) {
//       $key = str_replace('cm','',$key);
//     } else if (strpos($key,'米')!==false) {
//       $key = str_replace('米','',$key);
//       $isHeight = true;
//     } else if (strpos($key,'m')!==false) {
//       $key = str_replace('m','',$key);
//       $isHeight = true;
//     }  

//     $value = explode('-',$value);
//     $count = count($value);

//     if ($isHeight) {
//         if ($count==1) {
//             $result = '"height":'.$value[0];
//         }else{
//             $result = '"height1":'.$value[0].',"height2":'.$value[1];
//         }
//     }else {
//         if ($count==1) {
//             $result = '"dbh":'.$value[0];
//         }else{
//             $result = '"dbh1":'.$value[0].',"dbh2":'.$value[1];
//         }
//     }
//   }
//   if ($key) {
//     return $result ? '"key":"'.$key.'",'.$result : '"key":"'.$key.'"';
//   }else{
//     return $result;
//   }  
// }


// // // echo cn_2_num('壹仟壹佰壹拾壹亿壹仟壹佰壹拾壹万壹仟壹佰壹拾壹')."\n";                                 
// echo decompositionKey('二十公分五角枫')."\n";  



// $url = 'http://mmbiz.qpic.cn/mmbiz_jpg/ObnNseFZoCxy7iaunbCPrtry90v1hvfPzFwQWicXFLrPQiaJa1Dganqz80LZIFXHvvy7SU8f8j3oMichXSVsnxDibyw/0?wx_fmt=jpeg';
// $contents = file_get_contents($url); 
// echo $contents;
// file_put_contents('1.jpg', $contents);

// echo json_encode($_SERVER);

// $url = "https://mp.weixin.qq.com/s?__biz=MjM5MTQwMzA1OQ==&mid=400958110&idx=1&sn=928606f2518d4df82a1c581bca1efd93&scene=1&srcid=0921GF8tzkuGOmC2U1JfJIbP&from=singlemessage&isappinstalled=0&uin=MTMwMTQ4NTIwNA%3D%3D&key=1a6dc58b177dc62678d4686483fca5bc256e60fcdb7a7ee2f96e2e87e6155918f24b187e4502ca61d0535f6ad75b961f&devicetype=iMac+MacBookPro10%2C2+OSX+OSX+10.11.6+build(15G1004)&version=12000110&lang=en&nettype=WIFI&fontScale=100&pass_ticket=ISRebUQVwd%2BVKRA6bgAcLywWPxjLK3%2Fhg18wJUfUxUmjOaE4yqLB9QGffJXSmNtc"; 

// $url = 'https://mp.weixin.qq.com/s?__biz=MjM5MTQwMzA1OQ==&mid=2650708745&idx=1&sn=676ebda3e36a370fbfbd5cc2df8a1a2b&scene=4&uin=MTMwMTQ4NTIwNA%3D%3D&key=1a6dc58b177dc626f67f47b754832a4a3a3b108552407a7e3f2df1bb5a097e82741f030a2850d55bb5eb3d3f9925d8ad&devicetype=iMac+MacBookPro10%2C2+OSX+OSX+10.11.6+build(15G1004)&version=12000110&lang=en&nettype=WIFI&fontScale=100&pass_ticket=ISRebUQVwd%2BVKRA6bgAcLywWPxjLK3%2Fhg18wJUfUxUmjOaE4yqLB9QGffJXSmNtc';
// $url = 'http://mp.weixin.qq.com/s?src=3&timestamp=1485008654&ver=1&signature=pem8yF2kPH7pDTspCraWIbQz4k-a*oKGNikKOIbYt15oTnbXZiVpBZeVvNvAksljqIzceEyoXeq-JnSo*T9Ak2ZzN63U5BdTCfRpnglUZK2ItzId1qpE9qvAAIdxiuqLruOk0GnI9aVHBDsKgAWHwi4b0ZndW2Fv9QVY5mBWo40=';

// $url = 'http://mp.weixin.qq.com/s/2khGqU2ownDGgyiKmpF9uQ';

// $contents = file_get_contents($url); 
// echo $contents; 
// //如果出现中文乱码使用下面代码 
// //$getcontent = iconv("gb2312", "utf-8",$contents); 





// $str = strstr($contents, 'var msg_title');
// $end_pos = strpos($str, 'var user_uin');
// $str = substr($str, 0, $end_pos);

// echo $str.'<br>';

// $result = array();
// $vars  = explode("\";", $str);
// foreach ($vars as $key => $var) {
//   $var = explode(' = "', $var);
//   echo $var[0].'<br>';
//   echo str_replace('\x26amp;', '&', $var[1]).'<br>';

//   $var_name = $var[0];
//   $msg_pos = strpos($var_name, 'msg');
//   if ($msg_pos>0) {
//     $var_name = substr($var_name, $msg_pos);
//     $result[$var_name] = str_replace('\x26amp;', '&', $var[1]);
//   }
// // }
// include 'com/wechat.importnews.php';
// $result = importnews($url);

// echo var_dump($result);

// // $i = strpos($contents, 'var msg_cdn_url');
// $j = strpos($str, 'var msg_link');

// $img_url = substr($str, 0, $j);

// $img_url = strstr($img_url, '"');

// $j = strripos($img_url, '"');

// $img_url = substr($img_url, 1, $j-1);


// echo $img_url;


// $contents = str_replace('data-src', 'src', $contents);
// echo $contents; 


// var msg_title = "“一言不和”就去参观他的苗圃！";
//     var msg_desc = "苗木经纪人聚起是一团火，散开是满天星！用实际行动践行“义”、“徳”二字！";
//     var msg_cdn_url = "http://mmbiz.qpic.cn/mmbiz_jpg/3uSn2v4E2Jic9CicpvEETiaHHmJeacoO6Htfb8GAKZwMYJpfaSZeDsvEwXzI6g6w8D3iaeCrdenM1jwbNp1CzTvmibw/0?wx_fmt=jpeg";
//     var msg_link = "http://mp.weixin.qq.com/s?__biz=MjM5MTQwMzA1OQ==\x26amp;mid=2650708745\x26amp;idx=1\x26amp;sn=676ebda3e36a370fbfbd5cc2df8a1a2b#rd";
//     var user_uin = "0"*1;



    // var msg_title = "是谁签约找树网战略合作伙伴？";
    // var msg_desc = "伯乐与马！";
    // var msg_cdn_url = "http://mmbiz.qpic.cn/mmbiz/3uSn2v4E2Jic8jmj1fyibuTSibjMNbibOQicA9ccuNKSo96xy7fQHiaEP2k0djYwibwI1OHIA2SvQM0WsPBRicqm61fttw/0?wx_fmt=jpeg";
    // var msg_link = "http://mp.weixin.qq.com/s?__biz=MjM5MTQwMzA1OQ==&amp;mid=400958110&amp;idx=1&amp;sn=928606f2518d4df82a1c581bca1efd93#rd";
    // var user_uin = "1301485204"*1;




// echo __FILE__ .'<br>'; // 取得当前文件的绝对地址，结果：D:\www\test.php 
// echo dirname(__FILE__).'<br>'; // 取得当前文件所在的绝对目录，结果：D:\www\ 
// echo dirname(dirname(__FILE__)).'<br>'; //取得当前文件的上一层目录名，结果：D:\ 
// echo $_SERVER['DOCUMENT_ROOT'].'<br>';

// echo copy('../platform/about.php', '../platform/about1.php').'  --<br>';
// echo copy('./../platform/about.php', './../platform/about2.php').'  --<br>';
// echo copy($_SERVER['DOCUMENT_ROOT'].'/platform/about.php', $_SERVER['DOCUMENT_ROOT'].'/platform/about3.php').'  --<br>';

// include 'com/basic.php';

// $str_encode = basic::encode('AAA🌲国槐-白蜡🌲13932741528');

// echo $str_encode.'<br>';

// echo basic::decode($str_encode).'<br><br>';

// $str_base64 = base64_encode('AAA🌲国槐-白蜡🌲13932741528');
// echo $str_base64.'<br>';

// echo base64_decode($str_base64).'<br><br>';
// LHYpQCtYWwIldwJVfSBfUn4qC1c=

// $tel='010-89359916';

// $isMob="/^1[3-5,8]{1}[0-9]{9}$/";
//  $isTel="/^([0-9]{3,4}-)?[0-9]{7,8}$/";
//  if(!preg_match($isMob,$tel) && !preg_match($isTel,$tel))
//  {
//   echo '<script>alert("手机或电话号码格式不正确。如果是固定电话，必须形如(xxxx-xxxxxxxx)!");history.go(-1);</script>';
  
//  } else {
//  	echo 'ok';
//  }

//  $tel='17701305541';

// $isMob="/^1[3-5,8]{1}[0-9]{9}$/";
//  $isTel="/^([0-9]{3,4}-)?[0-9]{7,8}$/";
//  if(!preg_match($isMob,$tel) && !preg_match($isTel,$tel))
//  {
//   echo '<script>alert("手机或电话号码格式不正确。如果是固定电话，必须形如(xxxx-xxxxxxxx)!");history.go(-1);</script>';
  
//  } else {
//  	echo 'ok';
//  }



   //  function isPhone($tel)
   //  {
   //      $isMob="/^1[3-5,7-8]{1}[0-9]{9}$/";
 		// $isTel="/^([0-9]{3,4}-)?[0-9]{7,8}$/";      
   //      return preg_match($isMob,$tel) || preg_match($isTel,$tel);
   //  }

   //  echo isPhone('13801305541').' 1<br>';
   //  echo isPhone('13801305541').' 1<br>';
   //  echo isPhone('0312-3121002').' 1<br>';

?>