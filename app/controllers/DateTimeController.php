<?php

// DEFAULT TIMEZONE
date_default_timezone_set('America/Argentina/Buenos_Aires');

class DateTimeController
{
    public static function getNowAsMySQL()
    {
        $now = new DateTime();
        $nowStamp = $now->getTimestamp();;
        $mySQlDate = date('Y-m-d H:i:s',  $nowStamp);

        return $mySQlDate;
    }

    public static function getWaitingTime($mins)
    {
        $now = new DateTime();
        $intervalo = DateInterval::createFromDateString($mins . ' minutes');

        return $now->add($intervalo);
    }

    public static function MySQLToDateTime($mySQLString)
    {
        $timeStamp = strtotime($mySQLString);
        if ($timeStamp > 0) {
            $dateTime = new DateTime();
            $dateTime->setTimestamp($timeStamp);

            return $dateTime;
        }
    }

    public static function DateTimeToMySQL($dateTime)
    {
        if ($dateTime instanceof DateTime) {
            $timeStamp = $dateTime->getTimestamp();
            return date('Y-m-d H:i:s',  $timeStamp);
        }
    }
}
