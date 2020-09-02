<?php

namespace Sms\Helper;

class Phone
{
    public static function sanitize($phone)
    {
        return preg_replace("/[^0-9]/", "", $phone);
    }
}
