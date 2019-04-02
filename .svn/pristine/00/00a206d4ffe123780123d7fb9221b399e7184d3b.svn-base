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

class PhotoGPS {
    private static function angle2decimal($exifCoord, $banqiu)
    {
        $degrees= count($exifCoord) > 0 ? self::fraction2decimal($exifCoord[0]) : 0;
        $minutes= count($exifCoord) > 1 ? self::fraction2decimal($exifCoord[1]) : 0;
        $seconds= count($exifCoord) > 2 ? self::fraction2decimal($exifCoord[2]) : 0;


        $lng_lat = $degrees + $minutes/60 + $seconds/3600;

        if(strtoupper($banqiu) == 'W' || strtoupper($banqiu) == 'S'){
            //如果是南半球 或者 西半球 乘以-1
            $lng_lat = $lng_lat * -1;
        }

        return $lng_lat;
    }

    // 分数 转 小数
    private static function fraction2decimal($coordPart)
    {
        $parts= explode('/', $coordPart);
        if(count($parts) <= 0) return 0;
        if(count($parts) == 1) return $parts[0];

        return floatval($parts[0]) / floatval($parts[1]);
    }


    /**
     * 获取图片GPS，腾讯GCJ格式
     * 
     * @param $exif['GPS'];
     * @return string
     */
    public static function qqGps($exifGPS)
    {   
        $latitude = self::angle2decimal( $exifGPS['GPSLatitude'], $exifGPS['GPSLatitudeRef'] ); //纬度
        $longitude = self::angle2decimal( $exifGPS['GPSLongitude'], $exifGPS['GPSLongitudeRef'] ); //经度

        $qq_gps = GPS::gps2gcj( $latitude, $longitude);
        
        $gps = round($qq_gps['lat'],6).','.round($qq_gps['lon'],7);

        return  strlen($gps) >10 ? $gps : null;
    }
}

?>