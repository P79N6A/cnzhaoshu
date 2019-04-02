<?php

class basic 
{
    public static function filter($content)
    {
        $badkeys = array(' or ','delete','update','drop','alter','insert','select');
        $content_lower = strtolower($content);
        
        foreach ($badkeys as $key) {
            if (strstr($content_lower, $key) !== false) return '';
        }

        $content = trim($content);
        $content = str_replace("\n", '', $content);
        $content = str_replace("'", '', $content);
        $content = str_replace('"', '', $content);
        $content = str_replace('\\', '', $content);
        $content = str_replace(',', '，', $content);
        $content = str_replace(';', '；', $content);
        return $content;
    }

    public function str2number($str)
    {
        $number = array("零"=>0,"一"=>1,"二"=>2,"三"=>3,"四"=>4,"五"=>5,"六"=>6,"七"=>7,"八"=>8,"九"=>9,"十"=>10,"十一"=>11,"十二"=>12,"十三"=>13,"十四"=>14,"十五"=>15,"十六"=>16,"十七"=>17,"十八"=>18,"十九"=>19);
        $n = $number[$str];
        return $n ? $n : $str;
    }

	/**
	* 验证手机号码格式
    * 
    * @param string $tel 手机号码
    * @return boolean
	*/
    public static function isPhone($tel)
    {
        $isMob="/^1[3-5,7-8]{1}[0-9]{9}$/";
        $isTel="/^([0-9]{3,4}-)?[0-9]{7,8}$/";      
        return preg_match($isMob,$tel) || preg_match($isTel,$tel);
    }

    public static function getMillisecond() {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }

    /**
     * 保存文件
     * 
     * @param string $fileName 文件名（含相对路径）
     * @param string $content 文件内容
     * @return boolean 
     */
    public static function saveFile($fileName, $content)
    {
        if (!$fileName || !$content)
            return false;

        if (self::makeDir(dirname($fileName))) {
            if ($fp = fopen($fileName, "w")) {
                if (@fwrite($fp, $content)) {
                    fclose($fp);
                    return true;
                } else {
                    fclose($fp);
                    return false;
                } 
            } 
        } 
        return false;
    } 

    /**
     * 连续创建目录
     * 
     * @param string $dir 目录字符串
     * @param int $mode 权限数字
     * @return boolean 
     */
    private static function makeDir($dir)
    {
        if (!dir) return false;

        if(!file_exists($dir)) {
            return mkdir($dir);     //mkdir($dir,$mode,true);
        } else {
            return true;
        }
        
    }


    /**
     * 压缩图片
     * 
     * @param $image imagecreatefromstring($img);
     * @return $new_image
     */
    public static function resizeImage($image, $new_width, $new_height)
    {
        $width = imagesx($image);
        $height = imagesy($image);

        if ($width >= $height) {
            $new_height = $new_width*$height/$width;
        }else{
            $new_width = $new_height*$width/$height;
        }

        // 重新取样
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        return $new_image;
    }
    // 居中中截取方形图片
    public static function squareImage2($image, $side_length)
    {
        $width = imagesx($image);
        $height = imagesy($image);

        $src_x = 0;
        $src_y = 0;

        if ($width >= $height) {
            $src_x = round( ($width - $height)/2 );
            $width = $height;
        }else{
            $src_y = round( ($height - $width)/2 );
            $height = $width;
        }
        // 没有指定边长，原始大小居中取正方形
        if (!$side_length) $side_length = $width;

        // 重新取样
        $new_image = imagecreatetruecolor($side_length, $side_length);
        imagecopyresampled($new_image, $image, 0, 0, $src_x, $src_y, $side_length, $side_length, $width, $height);
        return $new_image;
    }

    // 方形图片，窄的透明补空白
    public static function squareImage($image, $side_length)
    {
        $width = imagesx($image);
        $height = imagesy($image);

        $x = 0;
        $y = 0;

        if ($width < $height) {
            $x = round( ($height - $width)/2 );
            // $width = $height;
        }else{
            $y = round( ($width - $height)/2 );
            // $height = $width;
        }
        // 没有指定边长，原始大小居中取正方形
        if (!$side_length) $side_length = max($width, $height);

        // 重新取样
        $new_image = imagecreatetruecolor($side_length, $side_length);
        $white = imagecolorallocate($new_image, 255, 255, 255);
        imagefill($new_image, 0, 0, $white);
        // $bg = imagecolorallocatealpha($new_image , 0 , 0 , 0 , 127);//拾取一个完全透明的颜色，不要用imagecolorallocate拾色
        // imagealphablending($new_image , false);//关闭混合模式，以便透明颜色能覆盖原画板     imagefill($block , 0 , 0 , $bg);//填充 
        // imagesavealpha($new_image,true);//设置保存PNG时保留透明通道信息

        imagecopyresampled($new_image, $image, $x, $y, 0, 0, $width,$height,$width,$height);
        return $new_image;
    }

    /**
     * 下载
     * 
     * @param string $url;
     * @return string
     */
    public static function http_get($url)
    {
        $oCurl = curl_init();
        if(stripos($url,"https://")!==FALSE){
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
        if(intval($aStatus["http_code"])==200){
            return $sContent;
        }else{
            return false;
        }
    }

    /**
     * 生成随机字符串
     * 
     * @param $length=30;
     * @return string
     */
    public static function randChar($length=30){
       $str = null;
       $strPol = "abcdefghijklmnopqrstuvwxyz0123456789";
       $max = strlen($strPol)-1;

       for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
       }

       return $str;
    }

    /**
     * 加密
     * 
     * @param string;
     * @return string
     */
    public static function encode($string) {   
        $string = base64_encode ( $string );   
        $key = 'a2d8f1k6j3e';  
        $len = strlen ( $key );  
        $code = '';   
        for($i = 0; $i < strlen ( $string ); $i ++) {       
            $k = $i % $len;       
            $code .= $string [$i] ^ $key [$k];   
        }   
        return base64_encode ( $code );   
    }

    /**
     * 解密
     * 
     * @param string;
     * @return string
     */
    public static function decode($string) {   
        $string = base64_decode ( $string );   
        $key = 'a2d8f1k6j3e';  
        $len = strlen ( $key );  
        $code = '';   
        for($i = 0; $i < strlen ( $string ); $i ++) {       
            $k = $i % $len;       
            $code .= $string [$i] ^ $key [$k];   
        }   
        return base64_decode ( $code );   
    }
}
?>