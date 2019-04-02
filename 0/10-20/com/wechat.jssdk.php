<?php
require 'checkhost.php';

class JSSDK {
  private $appId = 'wx400fa6a12644f696';
  private $appSecret = 'f29f23074b3e749550de6e85798c4737';
  private $platformId = 'gh_2d3d15b33f34';

  public function __construct($appId, $appSecret, $platformId) {
    isset($appId) && $this->appId = $appId;
    isset($appSecret) && $this->appSecret = $appSecret;
    isset($platformId) && $this->platformId = $platformId;
  }

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

$jssdk = new JSSDK();
$signPackage = $jssdk->GetSignPackage($_REQUEST['url']);

echo json_encode($signPackage);

?>