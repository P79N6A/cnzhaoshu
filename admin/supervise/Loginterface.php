<?php
require './Log.php';
class Loginterface extends Others_Log
{

    /**
     * @param unknown_type $file
     * @param unknown_type $msg
     */
    public  static  $msg=array();
    public static  $body=array();
    public static $file="";
    public static $charset="";

    /**
     *开始记录日志*
     *
     */
    public  function start($fname="",$charset="")
    {
        self::$msg=array();
        self::$body=array();
        self::$file=$fname.date("Ymd").".log";
        // 获取用户信息
        $user=json_decode($_COOKIE['user2'],true);
        $userid=isset($user['userid'])?$user['userid']:"";
        $tmp[]="\r\n时间：".date("Y-m-d H:i:s").'   IP：'.getIp().' Userid:'.$userid;
        $tmp[]="====================+++++++++++++++++++开始+++++++++++++++++++================\r\n";
        self::$msg[]=implode("\r\n",$tmp);
        self::$charset=$charset;
    }
    /**
     * 添加日志内容
     * @param [type] $msg [description]
     */
    public static  function add($msg)
    {
        ///判断编码  只有utf-8写入，非utf-8进行转码
        //if(is_string($msg) && strlen($msg)>0 && self::isGBK($msg)) $msg=iconv("GBK","UTF-8//IGNORE",$msg);
        if(is_string($msg) && strlen($msg)>0 && self::isGBK($msg)) $msg = mb_convert_encoding($msg,"UTF-8","GBK");

        if(count(self::$body)==0) self::$body[]="\r\n其它输出：";
        self::$body[]= "\r\n".$msg;
    }
    /**
     * 关闭日志
     * @return [type] [description]
     */
    public static  function end()
    {
        self::$msg[]=implode("\r\n",self::$body);
        self::$msg[]="====================+++++++++++++++++++结束+++++++++++++++++++================\r\n\r\n\r\n";
        /*以下进行编码转换*/
        $msg=implode("\r\n",self::$msg);
        //var_dump(self::$file);

        ///不是这几个接口文件，进行编码转换，因为这些是gb2312编码 。以后写日志，需要写入编码为：utf8就不会有乱码
        /*
        if(strlen($msg)>0 &&  !preg_match("/(sailsearch|sailpay|SUAN|HU|MU|CZ|HOTEL)/",self::$file))  ///gb2312 都需要写入这里
        {
            $msg=iconv("utf-8","gb2312//TRANSLIT",$msg);
        }
        */
        //if (is_string($msg) && strlen($msg)>0) $msg=iconv("UTF-8","GBK//IGNORE",$msg);  ///所有写入编码转为gbk,因为通过前面操作，所有已经是utf-8
        if (is_string($msg) && strlen($msg)>0) $msg = mb_convert_encoding($msg,"GBK","UTF-8");

        //self::write(self::$file,$msg,6);
        Others_Log::write(self::$file,$msg);
    }

    /***本写入日志文件，目前支持utf8与gbk ***/
    public static function isGBK($msg)
    {
        return is_string($msg)&&!mb_check_encoding($msg,'utf-8')?true:false;
    }

}