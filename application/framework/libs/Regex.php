<?php

abstract class Regex
{
    const
        EMAIL   = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",
        IPv4    = "^(?:25[0-5]|2[0-4]\\d|1\\d\\d|[1-9]\\d|\\d)(?:[.](?:25[0-5]|2[0-4]\\d|1\\d\\d|[1-9]\\d|\\d)){3}$",
        LENGTH  = "[]";

    public static function expression ( $expression, $param )
    {

    } 
}

?>