<?php

class GPS {
    private static $PI = 3.1415926535897932384626;
    private static $x_pi = 52.35987755983;
 
    //WGS-84 to GCJ-02
    public static function gps2gcj($wgsLat, $wgsLon) { 
        $d = self::delta($wgsLat, $wgsLon);
        return array('lat' => $wgsLat + $d['lat'],'lon' => $wgsLon + $d['lon']);
    }
 
    private static function delta($lat, $lon)
    {
        $a = 6378245.0;//  a: 卫星椭球坐标投影到平面地图坐标系的投影因子。
        $ee = 0.00669342162296594323;//  ee: 椭球的偏心率。
        $dLat = self::transformLat($lon - 105.0, $lat - 35.0);
        $dLon = self::transformLon($lon - 105.0, $lat - 35.0);
        $radLat = $lat / 180.0 * self::$PI;
        $magic = sin($radLat);
        $magic = 1 - $ee * $magic * $magic;
        $sqrtMagic = sqrt($magic);
        $dLat = ($dLat * 180.0) / (($a * (1 - $ee)) / ($magic * $sqrtMagic) * self::$PI);
        $dLon = ($dLon * 180.0) / ($a / $sqrtMagic * cos($radLat) * self::$PI);
        return array('lat' => $dLat, 'lon' => $dLon);
    }
 
    private static function transformLat($x, $y) {
        $ret = -100.0 + 2.0 * $x + 3.0 * $y + 0.2 * $y * $y + 0.1 * $x * $y + 0.2 * sqrt(abs($x));
        $ret += (20.0 * sin(6.0 * $x * self::$PI) + 20.0 * sin(2.0 * $x * self::$PI)) * 2.0 / 3.0;
        $ret += (20.0 * sin($y * self::$PI) + 40.0 * sin($y / 3.0 * self::$PI)) * 2.0 / 3.0;
        $ret += (160.0 * sin($y / 12.0 * self::$PI) + 320 * sin($y * self::$PI / 30.0)) * 2.0 / 3.0;
        return $ret;
    }
 
    private static function transformLon($x, $y) {
        $ret = 300.0 + $x + 2.0 * $y + 0.1 * $x * $x + 0.1 * $x * $y + 0.1 * sqrt(abs($x));
        $ret += (20.0 * sin(6.0 * $x * self::$PI) + 20.0 * sin(2.0 * $x * self::$PI)) * 2.0 / 3.0;
        $ret += (20.0 * sin($x * self::$PI) + 40.0 * sin($x / 3.0 * self::$PI)) * 2.0 / 3.0;
        $ret += (150.0 * sin($x / 12.0 * self::$PI) + 300.0 * sin($x / 30.0 * self::$PI)) * 2.0 / 3.0;
        return $ret;
    }
}

?>