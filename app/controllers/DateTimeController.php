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

    public static function getPreparationDateTime($mins)
    {
        $now = new DateTime();
        $intervalo = DateInterval::createFromDateString($mins . ' minutes');

        $preparationDateTimeString = self::DateTimeToMySQL($now->add($intervalo));
        return $preparationDateTimeString;
    }

    public static function getRemainingMinutes($preparationDateTimeString)
    {
        $now = new DateTime();
        $dateTime = self::MySQLToDateTime($preparationDateTimeString);
        $interval = date_diff($now, $dateTime);
        if ($interval->d < 1 && !$interval->invert) {
            $mins = $interval->i;
            $mins += $interval->h * 60;

            return $mins;
        } else {
            throw new UnexpectedValueException("Preparation DateTime must exist in future time.");
        }
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
