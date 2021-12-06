<?php
namespace app\core;

class Helper {

    public static function ConvertDateTime($datetime) {
            //ca;;ed as Helper::ConvertDateTime
            $date = new \Datetime($datetime, new \DateTimezone("UTC"));
            $tz = new \DateTimeZone(date_default_timezone_get());
            $date->setTimeZone($tz);
            return $date->format('Y-m-d H:i:s');
    }
}