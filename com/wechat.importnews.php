<?php
// $result['msg_title'] // 标题
// $result['msg_desc'] // 描述
// $result['msg_cdn_url'] // 封面图片地址
// $result['msg_link'] // 原文链接

function importnews($url)
{
  $contents = file_get_contents($url); 

  $var_string = strstr($contents, 'var nickname');  

  $end_pos = strpos($var_string, 'var user_uin');
  $var_string = substr($var_string, 0, $end_pos);

  $result = array();
  $vars  = explode("\";", $var_string);
  foreach ($vars as $key => $var) {
    $var = explode(' = "', $var);

    $var_name = $var[0];
    $msg_pos = strpos($var_name, 'var ');
    if ($msg_pos>0) {
      $var_name = substr($var_name, $msg_pos+4);
      $result[$var_name] = str_replace('\x26amp;', '&', $var[1]);
    }
  }

  $result['msg_title'] = str_replace('\x26quot;', '"', $result['msg_title']);
  $result['msg_desc'] = str_replace('\x26quot;', '"', $result['msg_desc']);

  return $result;
}


?>