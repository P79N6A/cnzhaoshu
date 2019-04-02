<?php

class Wechat
{
	const MSGTYPE_TEXT = 'text';
	const MSGTYPE_IMAGE = 'image';
	const MSGTYPE_LOCATION = 'location';
	const MSGTYPE_LINK = 'link';
	const MSGTYPE_EVENT = 'event';
	const MSGTYPE_MUSIC = 'music';
	const MSGTYPE_NEWS = 'news';
	const MSGTYPE_VOICE = 'voice';
	const MSGTYPE_VIDEO = 'video';
	const MSGTYPE_SHORTVIDEO = 'shortvideo';
	const API_URL_PREFIX = 'https://api.weixin.qq.com/cgi-bin';
	const AUTH_URL = '/token?grant_type=client_credential&';
	const MENU_CREATE_URL = '/menu/create?';
	const MENU_GET_URL = '/menu/get?';
	const MENU_DELETE_URL = '/menu/delete?';
	const MEDIA_GET_URL = '/media/get?';
	const CALLBACKSERVER_GET_URL = '/getcallbackip?';
	const QRCODE_CREATE_URL='/qrcode/create?';
	const QR_SCENE = 0;
	const QR_LIMIT_SCENE = 1;
	const QRCODE_IMG_URL='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=';
	const SHORT_URL='/shorturl?';
	const USER_GET_URL='/user/get?';
	const USER_INFO_URL='/user/info?';
	const USER_INFO_BATCH_URL='/user/info/batchget?access_token=';
	const USER_UPDATEREMARK_URL='/user/info/updateremark?';	
	const GROUP_GET_URL='/groups/get?';
	const USER_GROUP_URL='/groups/getid?';
	const GROUP_CREATE_URL='/groups/create?';
	const GROUP_UPDATE_URL='/groups/update?';
	const GROUP_MEMBER_UPDATE_URL='/groups/members/update?';
	const CUSTOM_SEND_URL='/message/custom/send?';
	const MEDIA_UPLOADNEWS_URL = '/media/uploadnews?';
	const MASS_SEND_URL = '/message/mass/send?';
	const TEMPLATE_SEND_URL = '/message/template/send?';
	const MASS_SEND_GROUP_URL = '/message/mass/sendall?';
	const MASS_DELETE_URL = '/message/mass/delete?';
	const MEDIA_UPLOAD = '/media/upload?';
	const OAUTH_PREFIX = 'https://open.weixin.qq.com/connect/oauth2';
	const OAUTH_AUTHORIZE_URL = '/authorize?';
	const OAUTH_TOKEN_PREFIX = 'https://api.weixin.qq.com/sns/oauth2';
	const OAUTH_TOKEN_URL = '/access_token?';
	const OAUTH_REFRESH_URL = '/refresh_token?';
	const OAUTH_USERINFO_URL = 'https://api.weixin.qq.com/sns/userinfo?';
	const OAUTH_AUTH_URL = 'https://api.weixin.qq.com/sns/auth?';
	const PAY_DELIVERNOTIFY = 'https://api.weixin.qq.com/pay/delivernotify?';
	const PAY_ORDERQUERY = 'https://api.weixin.qq.com/pay/orderquery?';
	const CUSTOM_SERVICE_GET_RECORD = '/customservice/getrecord?';
	const CUSTOM_SERVICE_GET_KFLIST = '/customservice/getkflist?';
	const CUSTOM_SERVICE_GET_ONLINEKFLIST = '/customservice/getkflist?';
	const SEMANTIC_API_URL= 'https://api.weixin.qq.com/semantic/semproxy/search?';
	const COMPONENT_TOKEN_URL = 'https://api.weixin.qq.com/cgi-bin/component/api_component_token';
	const AUTHORIZER_TOKEN_URL = 'https://api.weixin.qq.com/cgi-bin/component/api_authorizer_token?component_access_token=';
	
	private $token = 'zhaoshu';
	private $auth;	
	private $encodingAesKey;
	private $encrypt_type;
	private $appid = 'wx400fa6a12644f696';
	private $appsecret = 'f29f23074b3e749550de6e85798c4737';
	private $platformid = 'gh_2d3d15b33f34';
	private $access_token;
	private $user_token;
	private $partnerid;
	private $partnerkey;
	private $paysignkey;
	private $postxml;
	private $_msg;
	private $_funcflag = false;
	private $_receive;
	private $_text_filter = true;
	public $debug =  false;
	public $errCode = 40001;
	public $errMsg = "no access";
	private $_logcallback;
	

	public function getAuthorization($url){
		$url = self::OAUTH_PREFIX.self::OAUTH_AUTHORIZE_URL.'appid='.$this->appid.'&redirect_uri='.urlencode($url).'&response_type=code&scope=snsapi_userinfo&state=518#wechat_redirect';
		return $url;
	}

	// public function getAuthorization($url){
	// 	$url = self::OAUTH_TOKEN_PREFIX.self::OAUTH_TOKEN_URL.'appid='.$this->appid.'&secret='.$this->appsecret.'&response_type=code&scope=snsapi_userinfo&state=518#wechat_redirect';
	// 	return $url;
	// }

	public function __construct($options)
	{
		if ($options) {
			$this->token = isset($options['token'])?$options['token']:'';
			$this->auth = isset($options['auth'])?true:false;
			$this->encodingAesKey = isset($options['encodingaeskey'])?$options['encodingaeskey']:'';
			$this->appid = isset($options['appid'])?$options['appid']:'';
			$this->appsecret = isset($options['appsecret'])?$options['appsecret']:'';
			$this->platformid = isset($options['platformid'])?$options['platformid']:'';
			$this->partnerid = isset($options['partnerid'])?$options['partnerid']:'';
			$this->partnerkey = isset($options['partnerkey'])?$options['partnerkey']:'';
			$this->paysignkey = isset($options['paysignkey'])?$options['paysignkey']:'';
			$this->debug = isset($options['debug'])?$options['debug']:false;
			$this->_logcallback = isset($options['logcallback'])?$options['logcallback']:false;
		}
	}
	
	private function checkSignature($str='')
	{
        $signature = isset($_GET["signature"])?$_GET["signature"]:'';
	    $signature = isset($_GET["msg_signature"])?$_GET["msg_signature"]:$signature; //如果存在加密验证则用加密验证段
        $timestamp = isset($_GET["timestamp"])?$_GET["timestamp"]:'';
        $nonce = isset($_GET["nonce"])?$_GET["nonce"]:'';
        		
		$token = $this->token;
		$tmpArr = array($token, $timestamp, $nonce,$str);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
	public function valid($return=false)
    {
        $encryptStr="";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $postStr = file_get_contents("php://input");
            $array = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->encrypt_type = isset($_GET["encrypt_type"]) ? $_GET["encrypt_type"]: '';
            if ($this->encrypt_type == 'aes') { //aes加密
                $this->log($postStr);
            	$encryptStr = $array['Encrypt'];
            	$pc = new Prpcrypt($this->encodingAesKey);
            	$array = $pc->decrypt($encryptStr,$this->appid);
            	if (!isset($array[0]) || ($array[0] != 0)) {
            	    if (!$return) {
            	        die('decrypt error!');
            	    } else {
            	        return false;
            	    }
            	}
            	$this->postxml = $array[1];
            	if (!$this->appid)
            	    $this->appid = $array[2];//为了没有appid的订阅号。
            } else {
                $this->postxml = $postStr;
            }
        } elseif (isset($_GET["echostr"])) {
        	$echoStr = $_GET["echostr"];
        	if ($return) {
        		if ($this->checkSignature())
        			return $echoStr;
        		else
        			return false;
        	} else {
        		if ($this->checkSignature())
        			die($echoStr);
        		else
        			die('no access');
        	}
        }

        if (!$this->checkSignature($encryptStr)) {
        	if ($return)
        		return false;
        	else 
        		die('no access');
        }
        return true;
    }
    
    public function Message($msg = '',$append = false){
    		if (is_null($msg)) {
    			$this->_msg =array();
    		}elseif (is_array($msg)) {
    			if ($append)
    				$this->_msg = array_merge($this->_msg,$msg);
    			else
    				$this->_msg = $msg;
    			return $this->_msg;
    		} else {
    			return $this->_msg;
    		}
    }
    
    public function setFuncFlag($flag) {
    		$this->_funcflag = $flag;
    		return $this;
    }
    
    private function log($log){
    		if ($this->debug && function_exists($this->_logcallback)) {
    			if (is_array($log)) $log = print_r($log,true);
    			return call_user_func($this->_logcallback,$log);
    		}
    }
    
	public function getAccessToken()
	{
		return $this->access_token;
	}

	public function getRev()
	{
		if ($this->_receive) return $this;
		$postStr = !empty($this->postxml)?$this->postxml:file_get_contents("php://input");
		//兼顾使用明文又不想调用valid()方法的情况
		$this->log($postStr);
		if (!empty($postStr)) {
			$this->_receive = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		}
		return $this;
	}
	
	public function getRevData()
	{
		return $this->_receive;
	}
	
	public function getRevFrom() {
		if (isset($this->_receive['FromUserName']))
			return $this->_receive['FromUserName'];
		else 
			return false;
	}
	
	public function getRevTo() {
		if (isset($this->_receive['ToUserName']))
			return $this->_receive['ToUserName'];
		else if (isset($this->platformid))
			return $this->platformid;
		else
			return false;
	}
	
	public function getRevType() {
		if (isset($this->_receive['MsgType']))
			return $this->_receive['MsgType'];
		else 
			return false;
	}
	
	public function getRevID() {
		if (isset($this->_receive['MsgId']))
			return $this->_receive['MsgId'];
		else 
			return false;
	}
	
	public function getRevCtime() {
		if (isset($this->_receive['CreateTime']))
			return $this->_receive['CreateTime'];
		else 
			return false;
	}
	
	public function getRevContent(){
		if (isset($this->_receive['Content']))
			return $this->_receive['Content'];
		else if (isset($this->_receive['Recognition'])) //获取语音识别文字内容，需申请开通
			return $this->_receive['Recognition'];
		else
			return false;
	}
	
	public function getRevPic(){
		if (isset($this->_receive['PicUrl']))
			return array(
				'mediaid'=>$this->_receive['MediaId'],
				'picurl'=>(string)$this->_receive['PicUrl'],    //防止picurl为空导致解析出错
			);
		else 
			return false;
	}
	
	public function getRevLink(){
		if (isset($this->_receive['Url'])){
			return array(
				'url'=>$this->_receive['Url'],
				'title'=>$this->_receive['Title'],
				'description'=>$this->_receive['Description']
			);
		} else 
			return false;
	}
	
	public function getRevGeo(){
		if (isset($this->_receive['Location_X'])){
			return array(
				'x'=>$this->_receive['Location_X'],
				'y'=>$this->_receive['Location_Y'],
				'scale'=>$this->_receive['Scale'],
				'label'=>$this->_receive['Label']
			);
		} else 
			return false;
	}
	
	public function getRevEventGeo(){
        	if (isset($this->_receive['Latitude'])){
        		 return array(
				'x'=>$this->_receive['Latitude'],
				'y'=>$this->_receive['Longitude'],
				'precision'=>$this->_receive['Precision'],
			);
		} else
			return false;
	}
	
	public function getRevEvent(){
		if (isset($this->_receive['Event'])){
			$array['event'] = $this->_receive['Event'];
		}
		if (isset($this->_receive['EventKey'])){
			$array['key'] = $this->_receive['EventKey'];
		}
		if (isset($array) && count($array) > 0) {
			return $array;
		} else {
			return false;
		}
	}
	
	public function getRevVoice(){
		if (isset($this->_receive['MediaId'])){
			return array(
				'mediaid'=>$this->_receive['MediaId'],
				'format'=>$this->_receive['Format'],
			);
		} else 
			return false;
	}
	
	public function getRevVideo(){
		if (isset($this->_receive['MediaId'])){
			return array(
					'mediaid'=>$this->_receive['MediaId'],
					'thumbmediaid'=>$this->_receive['ThumbMediaId']
			);
		} else
			return false;
	}
	
	public function getRevTicket(){
		if (isset($this->_receive['Ticket'])){
			return $this->_receive['Ticket'];
		} else
			return false;
	}
	
	public function getRevSceneId (){
		if (isset($this->_receive['EventKey'])){
			return str_replace('qrscene_','',$this->_receive['EventKey']);
		} else{
			return false;
		}
	}
	
	public function getRevTplMsgID(){
		if (isset($this->_receive['MsgID'])){
			return $this->_receive['MsgID'];
		} else 
			return false;
	}
	
	public function getRevStatus(){
		if (isset($this->_receive['Status'])){
			return $this->_receive['Status'];
		} else 
			return false;
	}
	
	public static function xmlSafeStr($str)
	{   
		return '<![CDATA['.preg_replace("/[\\x00-\\x08\\x0b-\\x0c\\x0e-\\x1f]/",'',$str).']]>';   
	} 
	
	public static function data_to_xml($data) {
	    $xml = '';
	    foreach ($data as $key => $val) {
	        is_numeric($key) && $key = "item id=\"$key\"";
	        $xml    .=  "<$key>";
	        $xml    .=  ( is_array($val) || is_object($val)) ? self::data_to_xml($val)  : self::xmlSafeStr($val);
	        list($key, ) = explode(' ', $key);
	        $xml    .=  "</$key>";
	    }
	    return $xml;
	}	
	
	public function xml_encode($data, $root='xml', $item='item', $attr='', $id='id', $encoding='utf-8') {
	    if(is_array($attr)){
	        $_attr = array();
	        foreach ($attr as $key => $value) {
	            $_attr[] = "{$key}=\"{$value}\"";
	        }
	        $attr = implode(' ', $_attr);
	    }
	    $attr   = trim($attr);
	    $attr   = empty($attr) ? '' : " {$attr}";
	    $xml   = "<{$root}{$attr}>";
	    $xml   .= self::data_to_xml($data, $item, $id);
	    $xml   .= "</{$root}>";
	    return $xml;
	}

	private function _auto_text_filter($text) {
		if (!$this->_text_filter) return $text;
		return str_replace("\r\n", "\n", $text);
	}

	public function text($text='')
	{
		$FuncFlag = $this->_funcflag ? 1 : 0;
		$msg = array(
			'ToUserName' => $this->getRevFrom(),
			'FromUserName'=>$this->getRevTo(),
			'MsgType'=>self::MSGTYPE_TEXT,
			'Content'=>$this->_auto_text_filter($text),
			'CreateTime'=>time(),
			'FuncFlag'=>$FuncFlag
		);
		$this->Message($msg);
		return $this;
	}

	public function image($mediaid='')
	{
		$FuncFlag = $this->_funcflag ? 1 : 0;
		$msg = array(
			'ToUserName' => $this->getRevFrom(),
			'FromUserName'=>$this->getRevTo(),
			'MsgType'=>self::MSGTYPE_IMAGE,
			'Image'=>array('MediaId'=>$mediaid),
			'CreateTime'=>time(),
			'FuncFlag'=>$FuncFlag
		);
		$this->Message($msg);
		return $this;
	}
	
	public function voice($mediaid='')
	{
		$FuncFlag = $this->_funcflag ? 1 : 0;
		$msg = array(
			'ToUserName' => $this->getRevFrom(),
			'FromUserName'=>$this->getRevTo(),
			'MsgType'=>self::MSGTYPE_VOICE,
			'Voice'=>array('MediaId'=>$mediaid),
			'CreateTime'=>time(),
			'FuncFlag'=>$FuncFlag
		);
		$this->Message($msg);
		return $this;
	}

	public function video($mediaid='',$title='',$description='')
	{
		$FuncFlag = $this->_funcflag ? 1 : 0;
		$msg = array(
			'ToUserName' => $this->getRevFrom(),
			'FromUserName'=>$this->getRevTo(),
			'MsgType'=>self::MSGTYPE_VIDEO,
			'Video'=>array(
			        'MediaId'=>$mediaid,
			        'Title'=>$title,
			        'Description'=>$description
			),
			'CreateTime'=>time(),
			'FuncFlag'=>$FuncFlag
		);
		$this->Message($msg);
		return $this;
	}

	public function music($title,$desc,$musicurl,$hgmusicurl='') {
		$FuncFlag = $this->_funcflag ? 1 : 0;
		$msg = array(
			'ToUserName' => $this->getRevFrom(),
			'FromUserName'=>$this->getRevTo(),
			'CreateTime'=>time(),
			'MsgType'=>self::MSGTYPE_MUSIC,
			'Music'=>array(
				'Title'=>$title,
				'Description'=>$desc,
				'MusicUrl'=>$musicurl,
				'HQMusicUrl'=>$hgmusicurl
			),
			'FuncFlag'=>$FuncFlag
		);
		$this->Message($msg);
		return $this;
	}

	public function news($newsData=array())
	{
		$FuncFlag = $this->_funcflag ? 1 : 0;
		$count = count($newsData);
		
		$msg = array(
			'ToUserName' => $this->getRevFrom(),
			'FromUserName'=>$this->getRevTo(),
			'MsgType'=>self::MSGTYPE_NEWS,
			'CreateTime'=>time(),
			'ArticleCount'=>$count,
			'Articles'=>$newsData,
			'FuncFlag'=>$FuncFlag
		);
		$this->Message($msg);
		return $this;
	}

	public function reply($msg=array(),$return = false)
	{
		if (empty($msg)) 
			$msg = $this->_msg;
		$xmldata=  $this->xml_encode($msg);
		$this->log($xmldata);
		if ($this->encrypt_type == 'aes') { //如果来源消息为加密方式
		    $pc = new Prpcrypt($this->encodingAesKey);
		    $array = $pc->encrypt($xmldata, $this->appid);
		    $ret = $array[0];
		    if ($ret != 0) {
		        $this->log('encrypt err!');
		        return false;
		    }
		    $timestamp = time();
		    $nonce = rand(77,999)*rand(605,888)*rand(11,99);
		    $encrypt = $array[1];
		    $tmpArr = array($this->token, $timestamp, $nonce,$encrypt);//比普通公众平台多了一个加密的密文
		    sort($tmpArr, SORT_STRING);
		    $signature = implode($tmpArr);
		    $signature = sha1($signature);
		    $xmldata = $this->generate($encrypt, $signature, $timestamp, $nonce);
		    $this->log($xmldata);
		}
		if ($return)
			return $xmldata;
		else
			echo $xmldata;
	}

	private function generate($encrypt, $signature, $timestamp, $nonce)
	{
	    //格式化加密信息
	    $format = "<xml>
<Encrypt><![CDATA[%s]]></Encrypt>
<MsgSignature><![CDATA[%s]]></MsgSignature>
<TimeStamp>%s</TimeStamp>
<Nonce><![CDATA[%s]]></Nonce>
</xml>";
	    return sprintf($format, $encrypt, $signature, $timestamp, $nonce);
	}
	
	public function http_get($url){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		curl_setopt($oCurl, CURLOPT_TIMEOUT,30);		//30s timeout
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);

		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			return false;
		}
	}
	
	public function http_post($url,$param,$post_file=false){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		if (is_string($param) || $post_file) {
			$strPOST = $param;
		} else {
			$aPOST = array();
			foreach($param as $key=>$val){
				$aPOST[] = $key."=".urlencode($val);
			}
			$strPOST =  join("&", $aPOST);
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($oCurl, CURLOPT_POST,true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			return false;
		}
	}

	public function deleteAccessToken(){
		unlink($_SERVER['DOCUMENT_ROOT'].'/wechat/'.$this->getRevTo().'access_token');
	}
	
	public function checkAuth($appid='',$appsecret='',$token=''){
		if ($this->access_token) {
			return $this->access_token;
		}

    	$file_token = $_SERVER['DOCUMENT_ROOT']."/wechat/" . $this->getRevTo() . "access_token";
		$data = json_decode(file_get_contents( $file_token ));

	    if ($data && $data->expire_time > time()) {
	     	$this->access_token = $data->access_token;	    	
	    }else{
	    	if ($this->auth) {
	    		// 已认证授权的第三方开放平台 
	    		$this->getNewAuthAccessToken();
	    	} else {
	    		$this->getNewAccessToken();
			}
	    }

	    return $this->access_token;
	}

    private function getNewAccessToken(){
		$result = $this->http_get(self::API_URL_PREFIX.self::AUTH_URL.'appid='.$this->appid.'&secret='.$this->appsecret);
		
		if ($result){
			$json = json_decode($result,true);
			if (!$json || isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				$this->access_token = null;
			}else{
				$this->access_token = $json['access_token'];
				
				$data = array();
				$data['access_token'] = $json['access_token'];
				$data['expire_time'] = time() + $json['expires_in'] - 200;
    	
    			$file_token = $_SERVER['DOCUMENT_ROOT']."/wechat/" . $this->getRevTo() . "access_token";
        		file_put_contents( $file_token, json_encode($data) ); // 缓存
		    }
		}else{
			$this->access_token = null;
		}
    }

    private function getNewAuthAccessToken(){
    	$component_access_token = $this->checkComponentAccessToken();

    	$file_refresh_token = $_SERVER['DOCUMENT_ROOT']."/wechat/" . $this->getRevTo() . "refresh_token";
        $refresh_token = file_get_contents ( $file_refresh_token );
        $refresh_token = json_decode( $refresh_token, true );

		$data = '{
			"component_appid":"' . $this->appid . '",
			"authorizer_appid":"' . $refresh_token['authorizer_appid'] . '",
			"authorizer_refresh_token":"' . $refresh_token['authorizer_refresh_token'] . '"
		}';


		$result = $this->http_post( self::AUTHORIZER_TOKEN_URL . $component_access_token, $data);
		
		if ($result){
			$json = json_decode($result,true);
			if (!$json || isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				$this->access_token = null;
			}else{
				$this->access_token = $json['authorizer_access_token'];
				
				$data = array();
				$data['access_token'] = $json['authorizer_access_token'];
				$data['expire_time'] = time() + $json['expires_in'] - 200;

    			$file_token = $_SERVER['DOCUMENT_ROOT']."/wechat/" . $this->getRevTo() . "access_token";
        		file_put_contents( $file_token, json_encode($data) ); // 缓存

                $refresh_token_data = '{"authorizer_appid":"' . $refresh_token['authorizer_appid'] . '","authorizer_refresh_token":"' . $json['authorizer_refresh_token'] . '"}';
                file_put_contents( $file_refresh_token, $refresh_token_data );	    
            }
		}else{
			$this->access_token = null;
		}
    }

	private function checkComponentAccessToken()
	{
		$nowTime = time ();  

		// 从本地缓存获取component_access_token
    	$file_token = $_SERVER['DOCUMENT_ROOT']."/wechat/" . $this->appid . ".token";
		$cache = file_get_contents ( $file_token );  
		if ($cache) {
		    $cacheArray = json_decode ( $cache, true );  
		    if ( $cacheArray['expires_in'] > $nowTime + 200) {  
		        return $cacheArray['component_access_token'];
		    }  
		}  

		// 若本地缓存不存在或已失效，则从微信服务器重新获取  
    	$file_ticket = $_SERVER['DOCUMENT_ROOT']."/wechat/" . $this->appid . ".ticket";
	    $ticket = file_get_contents ( $file_ticket );  
	    $data = '{  
	            "component_appid":"' . $this->appid . '",  
	            "component_appsecret":"' . $this->appsecret . '",  
	            "component_verify_ticket":"' . $ticket . '"  
	    }';  


	    $result = $this->http_post ( self::COMPONENT_TOKEN_URL, $data );  
	    if ($result) {
	      $json = json_decode($result,true);
	      // 缓存到本地  
	      if (isset ( $json['component_access_token'] )) { 		          
	          $json['expires_in'] += $nowTime;  
	          file_put_contents ( $file_token, json_encode ( $json ) );  

	          $component_access_token = $json['component_access_token'];
	      }  
	    }

		return $component_access_token;		
	}

	static function json_encode($arr) {
		$parts = array ();
		$is_list = false;
		//Find out if the given array is a numerical array
		$keys = array_keys ( $arr );
		$max_length = count ( $arr ) - 1;
		if (($keys [0] === 0) && ($keys [$max_length] === $max_length )) { //See if the first key is 0 and last key is length - 1
			$is_list = true;
			for($i = 0; $i < count ( $keys ); $i ++) { //See if each key correspondes to its position
				if ($i != $keys [$i]) { //A key fails at position check.
					$is_list = false; //It is an associative array.
					break;
				}
			}
		}
		foreach ( $arr as $key => $value ) {
			if (is_array ( $value )) { //Custom handling for arrays
				if ($is_list)
					$parts [] = self::json_encode ( $value ); /* :RECURSION: */
				else
					$parts [] = '"' . $key . '":' . self::json_encode ( $value ); /* :RECURSION: */
			} else {
				$str = '';
				if (! $is_list)
					$str = '"' . $key . '":';
				//Custom handling for multiple data types
				if (is_numeric ( $value ) && $value<2000000000)
					$str .= $value; //Numbers
				elseif ($value === false)
				$str .= 'false'; //The booleans
				elseif ($value === true)
				$str .= 'true';
				else
					$str .= '"' . addslashes ( $value ) . '"'; //All other things
				// :TODO: Is there any more datatype we should be in the lookout for? (Object?)
				$parts [] = $str;
			}
		}
		$json = implode ( ',', $parts );
		if ($is_list)
			return '[' . $json . ']'; //Return numerical JSON
		return '{' . $json . '}'; //Return associative JSON
	}

	/**
	 * 创建菜单
	 * @return boolean
	 */
	public function createMenu($data){
		if (!$this->checkAuth()) return false;

		$result = $this->http_post(self::API_URL_PREFIX.self::MENU_CREATE_URL.'access_token='.$this->access_token,self::json_encode($data));
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return true;
		}
		return false;
	}
	
	/**
	 * 获取菜单
	 * @return array('menu'=>array(....s))
	 */
	public function getMenu(){
		if (!$this->checkAuth()) return false;

		$result = $this->http_get(self::API_URL_PREFIX.self::MENU_GET_URL.'access_token='.$this->access_token);
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $json;
		}
		return false;
	}
	
	/**
	 * 删除菜单
	 * @return boolean
	 */
	public function deleteMenu(){
		if (!$this->checkAuth()) return false;

		$result = $this->http_get(self::API_URL_PREFIX.self::MENU_DELETE_URL.'access_token='.$this->access_token);
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return true;
		}
		return false;
	}

	public function getMedia($media_id){
		if (!$this->checkAuth()) return false;

		$result = $this->http_get(self::API_URL_PREFIX.self::MEDIA_GET_URL.'access_token='.$this->access_token.'&media_id='.$media_id);
		if ($result)
		{
			$json = json_decode($result,true);
			if (isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $result;
		}
		return false;
	}

	public function sendMassMessage($data){
		if (!$this->checkAuth()) return false;
		$result = $this->http_post(self::API_URL_PREFIX.self::MASS_SEND_URL.'access_token='.$this->access_token,self::json_encode($data));
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $json;
		}
		return false;
	}
	
	public function sendGroupMassMessage($data){
		if (!$this->checkAuth()) return false;
		$result = $this->http_post(self::API_URL_PREFIX.self::MASS_SEND_GROUP_URL.'access_token='.$this->access_token,self::json_encode($data));
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $json;
		}
		return false;
	}
	
	public function deleteMassMessage($msg_id){
		if (!$this->checkAuth()) return false;
		$result = $this->http_post(self::API_URL_PREFIX.self::MASS_DELETE_URL.'access_token='.$this->access_token,self::json_encode(array('msg_id'=>$msg_id)));
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return true;
		}
		return false;
	}

	public function getQRCode($scene_id,$type=0,$expire=1800){
		if (!$this->checkAuth()) return false;
		$data = array(
			'action_name'=>$type?"QR_LIMIT_SCENE":"QR_SCENE",
			'expire_seconds'=>$expire,
			'action_info'=>array('scene'=>array('scene_id'=>$scene_id))
		);
		if ($type == 1) {
			unset($data['expire_seconds']);
		}

		$result = $this->http_post(self::API_URL_PREFIX.self::QRCODE_CREATE_URL.'access_token='.$this->access_token,self::json_encode($data));

		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $json;
		}
		return false;
	}
	
	public function getQRUrl($ticket) {
		return self::QRCODE_IMG_URL.$ticket;
	}
	
	public function getUserInfo($openid){
		if (!$this->checkAuth()) return false;
		$result = $this->http_get(self::API_URL_PREFIX.self::USER_INFO_URL.'access_token='.$this->access_token.'&openid='.$openid);
		if ($result)
		{
			$json = json_decode($result,true);
			if (isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $json;
		}
		return false;
	}

	public function getUserInfoBatch($data){
		if (!$this->checkAuth()) return false;
	    $result = $this->http_post(self::API_URL_PREFIX.self::USER_INFO_BATCH_URL.$this->access_token,json_encode($data));		
		if ($result)
		{
			$json = json_decode($result,true);
			if (isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $json;
		}
		return false;
	}
	
	public function sendCustomMessage($data){
		if (!$this->checkAuth()) return false;
		$result = $this->http_post(self::API_URL_PREFIX.self::CUSTOM_SEND_URL.'access_token='.$this->access_token,self::json_encode($data));
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $json;
		}
		return false;
	}

	public function sendTemplateMessage($data){
		if (!$this->checkAuth()) return false;
		$result = $this->http_post(self::API_URL_PREFIX.self::TEMPLATE_SEND_URL.'access_token='.$this->access_token,self::json_encode($data));
		if($result){
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			return $json;
		}

		return false;
	}

	public function querySemantic($uid,$query,$category,$latitude=0,$longitude=0,$city="",$region=""){
		if (!$this->checkAuth()) return false;
	    $data=array(
	            'query' => $query,
	            'category' => $category,
	            'appid' => $this->appid,
	            'uid' => ''
	    );
	    //地理坐标或城市名称二选一
	    if ($latitude) {
	        $data['latitude'] = $latitude;
	        $data['longitude'] = $longitude;
	    } elseif ($city) {
	        $data['city'] = $city;
	    } elseif ($region) {
	        $data['region'] = $region;
	    }
	    $result = $this->http_post(self::SEMANTIC_API_URL.'access_token='.$this->access_token,self::json_encode($data));
	    if ($result)
	    {
	        $json = json_decode($result,true);
	        if (!$json || !empty($json['errcode'])) {
	            $this->errCode = $json['errcode'];
	            $this->errMsg = $json['errmsg'];
	            return false;
	        }
	        return $json;
	    }
	    return false;
	}
}


class PKCS7Encoder
{
    public static $block_size = 32;

    function encode($text)
    {
        $block_size = PKCS7Encoder::$block_size;
        $text_length = strlen($text);
        //计算需要填充的位数
        $amount_to_pad = PKCS7Encoder::$block_size - ($text_length % PKCS7Encoder::$block_size);
        if ($amount_to_pad == 0) {
            $amount_to_pad = PKCS7Encoder::block_size;
        }
        //获得补位所用的字符
        $pad_chr = chr($amount_to_pad);
        $tmp = "";
        for ($index = 0; $index < $amount_to_pad; $index++) {
            $tmp .= $pad_chr;
        }
        return $text . $tmp;
    }

    function decode($text)
    {

        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > PKCS7Encoder::$block_size) {
            $pad = 0;
        }
        return substr($text, 0, (strlen($text) - $pad));
    }

}

class Prpcrypt
{
    public $key;

    function Prpcrypt($k)
    {
        $this->key = base64_decode($k . "=");
    }

    /**
     * 对明文进行加密
     * @param string $text 需要加密的明文
     * @return string 加密后的密文
     */
    public function encrypt($text, $appid)
    {

        try {
            //获得16位随机字符串，填充到明文之前
            $random = $this->getRandomStr();//"aaaabbbbccccdddd"; 
            $text = $random . pack("N", strlen($text)) . $text . $appid;
            // 网络字节序
            $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
            $iv = substr($this->key, 0, 16);
            //使用自定义的填充方式对明文进行补位填充
            $pkc_encoder = new PKCS7Encoder;
            $text = $pkc_encoder->encode($text);
            mcrypt_generic_init($module, $this->key, $iv);
            //加密
            $encrypted = mcrypt_generic($module, $text);
            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);

            //			print(base64_encode($encrypted));
            //使用BASE64对加密后的字符串进行编码
            return array(ErrorCode::$OK, base64_encode($encrypted));
        } catch (Exception $e) {
            //print $e;
            return array(ErrorCode::$EncryptAESError, null);
        }
    }

    public function decrypt($encrypted, $appid)
    {

        try {
            //使用BASE64对需要解密的字符串进行解码
            $ciphertext_dec = base64_decode($encrypted);
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
            $iv = substr($this->key, 0, 16);
            mcrypt_generic_init($module, $this->key, $iv);
            //解密
            $decrypted = mdecrypt_generic($module, $ciphertext_dec);
            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);
        } catch (Exception $e) {
            return array(ErrorCode::$DecryptAESError, null);
        }


        try {
            //去除补位字符
            $pkc_encoder = new PKCS7Encoder;
            $result = $pkc_encoder->decode($decrypted);
            //去除16位随机字符串,网络字节序和AppId
            if (strlen($result) < 16)
                return "";
            $content = substr($result, 16, strlen($result));
            $len_list = unpack("N", substr($content, 0, 4));
            $xml_len = $len_list[1];
            $xml_content = substr($content, 4, $xml_len);
            $from_appid = substr($content, $xml_len + 4);
            if (!$appid)
                $appid = $from_appid;
            //如果传入的appid是空的，则认为是订阅号，使用数据中提取出来的appid
        } catch (Exception $e) {
            //print $e;
            return array(ErrorCode::$IllegalBuffer, null);
        }
        if ($from_appid != $appid)
            return array(ErrorCode::$ValidateAppidError, null);
        //不注释上边两行，避免传入appid是错误的情况
        return array(0, $xml_content, $from_appid); //增加appid，为了解决后面加密回复消息的时候没有appid的订阅号会无法回复

    }


    function getRandomStr()
    {

        $str = "";
        $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($str_pol) - 1;
        for ($i = 0; $i < 16; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }
        return $str;
    }

}

class ErrorCode
{
    public static $OK = 0;
    public static $ValidateSignatureError = 40001;
    public static $ParseXmlError = 40002;
    public static $ComputeSignatureError = 40003;
    public static $IllegalAesKey = 40004;
    public static $ValidateAppidError = 40005;
    public static $EncryptAESError = 40006;
    public static $DecryptAESError = 40007;
    public static $IllegalBuffer = 40008;
    public static $EncodeBase64Error = 40009;
    public static $DecodeBase64Error = 40010;
    public static $GenReturnXmlError = 40011;
    public static $errCode=array(
            '0' => '处理成功',
            '40001' => '校验签名失败',
            '40002' => '解析xml失败',
            '40003' => '计算签名失败',
            '40004' => '不合法的AESKey',
            '40005' => '校验AppID失败',
            '40006' => 'AES加密失败',
            '40007' => 'AES解密失败',
            '40008' => '公众平台发送的xml不合法',
            '40009' => 'Base64编码失败',
            '40010' => 'Base64解码失败',
            '40011' => '公众帐号生成回包xml失败'
    );
    public static function getErrText($err) {
        if (isset(self::$errCode[$err])) {
            return self::$errCode[$err];
        }else {
            return false;
        };
    }
}
?>