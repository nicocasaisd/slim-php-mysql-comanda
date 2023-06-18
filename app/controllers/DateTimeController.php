<?php

class DateTimeController
{

    public static function getNowAsMySQL()
    {
        $now = new DateTime();
        $nowstamp = $now->getTimestamp();;
        $mysqldate = date('Y-m-d H:i:s',  $nowstamp);
        return $mysqldate;
    }
}
