<?php

namespace Omnitask\LaravelQueChecker\Repositories;

class QueCheckerRepository
{
    public static function getQueCheckInterval(){
        return self::getCronString(config('laravelqchecker.que_check_minutes_interval'));
    }

    public static function getQueCheckIfWorkingInterval(){
        return self::getCronString(config('laravelqchecker.que_check_minutes_interval') , 2);
    }

    private static function getCronString($minutesInterval, $startingMinute = 1){

        $minutesString = '';

        for ($i = $startingMinute; $i < 60; $i += $minutesInterval)
            $minutesString .= $i . ',';

        return rtrim($minutesString, ',') . ' '. config('laravelqchecker.que_check_hour_range') . ' * * *';

    }

    public static function getDeleteOldQueHeartbeatsTime(){
        return config('laravelqchecker.que_delete_old_heartbeats_time');
    }


}
