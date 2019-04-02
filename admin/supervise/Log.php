<?php
class Others_Log
{
    /**
     * 写入日志
     * @param unknown_type $file
     * @param unknown_type $msg
     */
    public static  function  write($file,$msg)
    {
        $logPath = "./log/".date("Ym")."/".date("Ymd")."/";
        self::Directory($logPath);
        $f = file_put_contents($logPath.$file, $msg,FILE_APPEND);  //在文件末尾写入日志
    }
    /**
     * 判断文件是否存在
     * @param [type] $dir [description]
     */
    public static function  Directory( $dir ){
           return  is_dir ( $dir ) or self::Directory(dirname( $dir )) and  mkdir ( $dir , 0777,true);
    }
    /**
     * 遍历创建文件夹或者文件
     * @param  [type] $path [description]
     * @return [type]       [description]
     */
    function createdir($path)
    {

        $arr=explode('/',dirname($path));
        $tmp = Data_Path;
        foreach ($arr as $a)
        {
            $tmp = $tmp.'/'.$a;
            if(!file_exists($tmp)) mkdir($tmp,0755);
        }
        return Data_Path."/".$path;
    }


}