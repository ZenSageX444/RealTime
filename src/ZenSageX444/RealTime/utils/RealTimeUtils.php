<?php

namespace ZenSageX444\RealTime\utils;

class RealTimeUtils{

    public static function getCurrentTime(): string{
        return date("H:i:s");
    }

    public static function getCurrentTimeInMinecraftTime(): int{
        $convertedTime = (self::getCurrentTimeInSeconds() * 24000) / 86400;
        if($convertedTime < 6000){
            return intval(18000 + $convertedTime);
        }
        return intval($convertedTime - 6000);
    }

    private static function getCurrentTimeInSeconds(): int{
        $now = new \DateTime();
        $midnight = new \DateTime($now->format('Y-m-d 00:00:00'));
        $duration = $midnight->diff($now);

        return $duration->s + ($duration->i * 60) + ($duration->h * 3600);
    }
}
