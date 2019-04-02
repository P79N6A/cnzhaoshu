<?php
class openid 
{
    private static function http_get($url){
        $oCurl = curl_init();
        if(stripos($url,'https://')!==FALSE){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);

        // echo $aStatus["content_type"];
        if(intval($aStatus['http_code'])==200){
            return $sContent;
        }else{
            return false;
        }
    }

    public static function getOpenid($code)
    {   
        $result = self::http_get('https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx0fc67840da12b408&secret=5dad172a8df8a513c43a5b0916c9325c&code='.$code.'&grant_type=authorization_code');
        var_dump($result);
        if ($result)
        {
            $json = json_decode($result,true);
            if (isset($json['openid'])) {
                return $json['openid'];
            } else {
                return false;
            }
        }
        return false;
    }
}
?>