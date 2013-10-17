<?php
class Utils {
    public static function time($timestamp){
        $date = "dd MMMM yyyy HH:mm";
        $formatter=new CDateFormatter('RU_ru');
        return $formatter->format($date, $timestamp);
    }
}