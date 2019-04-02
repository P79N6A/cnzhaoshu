<?php 


require 'wechat/wechat.class.php';
	
function getsignature($url){
	$weObj = new Wechat();
	$result = $weObj->getwxconfig($url);
	setcookie("signature",json_encode($result), time()+3600); 
}
