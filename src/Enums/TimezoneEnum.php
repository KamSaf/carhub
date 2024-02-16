<?php

namespace App\Enums;

enum TimezoneEnum: string
{
    case newYork = "America/New York";
    case chicago = "America/Chicago";
    case denver = "America/Denver";
    case losAngeles = "America/Los Angeles";
    case phoenix = "America/Phoenix";
    case toronto = "America/Toronto";
    case london = "Europe/London";
    case berlin = "Europe/Berlin";
    case madrid = "Europe/Madrid";
    case warsaw = "Europe/Warsaw";
    case kyiv = "Europe/Kyiv";
    case moscow = "Europe/Moscow";
    case tokyo = "Asia/Tokyo";
    case shanghai = "Asia/Shanghai";
    case dubai = "Asia/Dubai";
    case kolkata = "Asia/Kolkata";
    case sydney = "Australia/Sydney";
    case auckland = "Pacific/Auckland";

    public static function getArray(){
        return array_column(TimezoneEnum::cases(), 'value');
    }
}