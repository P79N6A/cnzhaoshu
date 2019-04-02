<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/10/22
 * Time: 14:09
 * 分享朋友圈接口
 */

include "../com/db.php";

class JSSDK {
	
  private $appId = 'wx0fc67840da12b408';
  
  private $appSecret = '5dad172a8df8a513c43a5b0916c9325c';
  
  private $platformId = 'gh_19006299728d';

  public function getSignPackage($url) {
	  
    $jsapiTicket = $this->getJsApiTicket();

    $timestamp = time();
	
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
	
      "appId"     => $this->appId,
	  
      "nonceStr"  => $nonceStr,
	  
      "timestamp" => $timestamp,
	  
      "url"       => $url,
	  
      "signature" => $signature,
	  
      "rawString" => $string
	  
    );
	
    return $signPackage;
	
  }

  private function createNonceStr($length = 16) {
	  
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	
    $str = '';
	
    for ($i = 0; $i < $length; $i++) {
		
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	  
    }
	
    return $str;
	
  }

  private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    $file_ticket = $_SERVER['DOCUMENT_ROOT'].'/wechat/'.$this->platformId.'jsapi_ticket';

    $data = json_decode(file_get_contents( $file_ticket ));
	
    if ($data->expire_time < time()) {
		
      $accessToken = $this->getAccessToken();
	  
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
	  
      $res = json_decode($this->httpGet($url));
	  
      $ticket = $res->ticket;
	  
      if ($ticket) {
		  
        $data->expire_time = time() + $data->expire_time_in - 200;
		
        $data->jsapi_ticket = $ticket;
		
        file_put_contents($file_ticket, json_encode($data));
		
      }
	  
    } else {
		
      $ticket = $data->jsapi_ticket;
	  
    }

    return $ticket;
	
  }

  private function getAccessToken() {
	  
    $file_token = $_SERVER['DOCUMENT_ROOT'].'/wechat/'.$this->platformId.'access_token';

    $data = json_decode(file_get_contents( $file_token ));


    if ($data->expire_time < time()) {
      // 过期重新获取
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
	  
      $res = json_decode($this->httpGet($url));
	  
      $access_token = $res->access_token;
	  
      if ($access_token) {
		  
        $data->expire_time = time() + $data->expire_time_in - 200;
		
        $data->access_token = $access_token;
		
        file_put_contents($file_token, json_encode($data));
		
      }
	  
    } else {
		
      $access_token = $data->access_token;
	  
    }
	
    return $access_token;
	
  }

  private function httpGet($url) {
	  
    $curl = curl_init();
	
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
	
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
	
    curl_close($curl);

    return $res;
	
  }
  
}

$url="http://test.cnzhaoshu.com/admin/share_friend.php";

$jssdk= new JSSDK();

$db=new db();

$project_id=isset($_POST['project_id'])?$_POST['project_id']:"";

if($project_id!=""){
	
    $project_name_sql="select project_name from order_project where project_id='".$project_id."'";

    $project_name=$db->query($project_name_sql)[0]['project_name'];
	
}else{
	
    $project_name="";
	
}

$signPackage = $jssdk->GetSignPackage($url);

$content=[

    'status'=>0,
	
    'project_name'=>$project_name,
	
    'signPackage'=>$signPackage
	
];

echo json_encode($content);