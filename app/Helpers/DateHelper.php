<?php


namespace App\Helpers;


use DateInterval;
use DatePeriod;
use DateTime;

class DateHelper
{
    public static function getPeriod($dateFrom, $dateTo, int $daysInterval)
    {
        $begin = new DateTime($dateFrom);
        $end = new DateTime($dateTo);
        $interval = DateInterval::createFromDateString($daysInterval.' day');
        $period = new DatePeriod($begin, $interval, $end);

        return $period;
    }

    public static function getCalendarDate($dateString)
    {
       $monthName = explode('-', $dateString);

       if(empty($monthName[1])){
           return null;
       }
       if(intval($monthName[1]) !== 0){
           return $dateString;
       }
       $day = explode('-', $dateString)[0];

       return  date('Y'). '-' . self::getMonthNumberFromString($monthName[1]) . '-' . $day;
    }

    public static function getMonthStringFromNumber($dateNumber)
    {
        switch ($dateNumber){
            case '01':
                $str = 'янв';
                break;
            case '02':
                $str = 'февр';
                break;
            case '03':
                $str = 'март';
                break;
            case '04':
                $str = 'апр';
                break;
            case '05':
                $str = 'май';
                break;
            case '06':
                $str = 'июнь';
                break;
            case '07':
                $str = 'июль';
                break;
            case '08':
                $str = 'авг';
                break;
            case '09':
                $str = 'сент';
                break;
            case '10':
                $str = 'окт';
                break;
            case '11':
                $str = 'нояб';
                break;
            case '12':
                $str = 'дек';
                break;
        }
        return $str;
    }

    public static function getMonthNumberFromString($dateString)
    {
        switch ($dateString){
            case 'Январь':
                $num = '01';
                break;
            case 'Февраль':
                $num = '02';
                break;
            case 'Март':
                $num = '03';
                break;
            case 'Апрель':
                $num = '04';
                break;
            case 'Май':
                $num = '05';
                break;
            case 'Июнь':
                $num = '06';
                break;
            case 'Июль':
                $num = '07';
                break;
            case 'Август':
                $num = '08';
                break;
            case 'Сентябрь':
                $num = '09';
                break;
            case 'Октябрь':
                $num = '10';
                break;
            case 'Ноябрь':
                $num = '11';
                break;
            case 'Декабрь':
                $num = '12';
                break;
            default:
                $num = '00';
                break;
        }
        return $num;
    }
}
