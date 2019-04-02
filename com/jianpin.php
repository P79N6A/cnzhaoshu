<?php

/*
 * 获取字符串首字母拼音字母
 $str = '猝老猫是我-php230';
 $jianpin = new JianPin();
 echo $jianpin->getAllChar($str); //输出LMSW-php230
*/
class JianPin
{
    /**
     * @param string $str
     * @param bool $allow   默认转换所有字符
     * @return Ambigous <unknown, string, string>
     */
    function getAllChar($str, $allow = TRUE)
    {
        if($allow){
            $length = mb_strlen($str, 'utf-8');
            $result = '';
            for($i=0; $i<$length; $i++){
                $subStr = $this->cutOutString($str, $i, 1);
                $result .= $this->getLetter($subStr);
            }
            return $result;
        }else{
            $subStr = $this->cutOutString($str, 0, 1);
            return $this->getLetter($subStr);
        }
    }
                                                                                                                                                                                             
    /**
     * 截取字符串第一个字符
     * @param string $string    需要被截取的字符串
     * @param int   $start      开始位置
     * @param int $length       截取长度
     * @param string $postfix   字符串截取后的后缀
     * @return string
     */
    function cutOutString($string, $start, $length, $postfix='')
    {
        $result = (mb_strlen($string, 'utf-8') <= $length) ? $string : mb_substr($string, $start, $length, 'utf-8');
        return $result.$postfix;
    }
                                                                                                                                                                                             
    /**
     * 获取字符串中文拼音首字母
     * @param string $str   需要转换的字符串
     * @return unknown|string
     */
    function getLetter($str)
    {
        $firest_ord = ord($str);
        if($firest_ord >= 48 && $firest_ord <= 57){
            return $str;    //数字
        }elseif($firest_ord >= 65 && $firest_ord <= 90){
            return $str;    //大写字母
        }elseif($firest_ord >=97 && $firest_ord <= 122){
            return $str;    //小写字母
        }
                                                                                                                                                                                                 
        //中文
        $s=iconv("UTF-8","gb2312//IGNORE", $str);
        $asc=ord($s{0})*256+ord($s{1})-65536;

        if($asc>=-20319 and $asc<=-20284)return "A";
        if($asc>=-20283 and $asc<=-19776)return "B";
        if($asc>=-19775 and $asc<=-19219 || $asc==-7513)return "C";
        if($asc>=-19218 and $asc<=-18711)return "D";
        if($asc>=-18710 and $asc<=-18527)return "E";
        if($asc>=-18526 and $asc<=-18240)return "F";
        if($asc>=-18239 and $asc<=-17923)return "G";
        if($asc>=-17922 and $asc<=-17418)return "H";
        if($asc>=-17417 and $asc<=-16475)return "J";
        if($asc>=-16474 and $asc<=-16213)return "K";
        if($asc>=-16212 and $asc<=-15641)return "L";
        if($asc>=-15640 and $asc<=-15166)return "M";
        if($asc>=-15165 and $asc<=-14923)return "N";
        if($asc>=-14922 and $asc<=-14915)return "O";
        if($asc>=-14914 and $asc<=-14631)return "P";
        if($asc>=-14630 and $asc<=-14150)return "Q";
        if($asc>=-14149 and $asc<=-14091)return "R";
        if($asc>=-14090 and $asc<=-13319)return "S";
        if($asc>=-13318 and $asc<=-12839)return "T";
        if($asc>=-12838 and $asc<=-12557)return "W";
        if($asc>=-12556 and $asc<=-11848)return "X";
        if($asc>=-11847 and $asc<=-11056)return "Y";
        if($asc>=-11055 and $asc<=-10247)return "Z";
        echo $str.'='.$asc.'<br>';
        return $str;
    }
}



?>