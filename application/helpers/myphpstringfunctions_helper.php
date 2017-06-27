<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('chgtolowercase'))
{
    function chgtolowercase($params)
    {
        $str = strtolower($params);
        return $str;
    }
}

if (!function_exists('chgtouppercase'))
{
    function chgtouppercase($params)
    {
        $str = strtoupper($params);
        return $str;
    }
}

//Make a string's first character uppercase
if (!function_exists('firstcharuppercase'))
{
    function firstcharuppercase($params)
    {
        $str = ucfirst($params);
        return $str;
    }
}

//lcfirst() - converts the first character of a string to lowercase
if (!function_exists('firstcharlowercase'))
{
    function firstcharlowercase($params)
    {
        $str = lcfirst($params);
        return $str;
    }
}
if (!function_exists('firstletter'))
{
        function firstletter($string) {
            if(!(empty($string))) {
                $str = substr($string, 0, 1);
                    return $str;
    }
}
}
if(!function_exists('daysInAMonth')){

    function daysInAMonth(int $month, int $year){

$days=cal_days_in_month(CAL_GREGORIAN,$month,$year);
          return $days;



    }

}

//strtoupper() - converts a string to uppercase
  //  lcfirst() - converts the first character of a string to lowercase
  //  ucfirst() - converts the first character of a string to uppercase
  //  ucwords() - converts the first character of each word in a string to uppercase
