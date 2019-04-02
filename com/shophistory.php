<?php

 
include 'wechat.importnews.php';
require('db.php');

  $db = new db();

  $url = $_GET['url'];
  $userid = $_GET['userid'];
  $result = importnews($url);


  $results = [];
  foreach ($result as $key => $value) {
    if($key != 'msg_cdn_url'){
      $results[$key] = $value;
    }
  }
  $sql = 'select shopid from user where userid = ?';
  $id = $db->prepare_query($sql , array($userid));
  $shopid = $id[0]['shopid'];

  $results['shopid'] = $shopid;



  $fileds = [];
  $values = [];
  $fileds_kay = [];

  foreach ($results as $key => $value) {
      array_push($fileds,$key);
      array_push($values,$value);
      array_push($fileds_kay,'?');

  }
  $sql = 'insert into shop_project('.join(',' , $fileds).') values('.join(',' , $fileds_kay).')';

  $repacid = $db->prepare_insert( $sql, $values );

  $newpath = '../shop/photo/c/'.$repacid.'.jpg';
  file_put_contents($newpath, file_get_contents($result['msg_cdn_url']));
  if($repacid){
    $results['id'] = $repacid;
    $resultes = [];
    $resultes[0] = $results;
    echo json_encode($resultes);
  }else{
    echo '0';
  }























  





?>