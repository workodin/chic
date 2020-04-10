<?php

class Config
{
    static $dsn = "";

    static function init ()
    {
        $appDir = realpath(__DIR__);
        $dbPath = "$appDir/data.db";
        Config::$dsn = "sqlite:$dbPath";        
    }
}

Config::init();

