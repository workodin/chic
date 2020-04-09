<?php

/**
 * 
 */
class App 
{
    // STATIC PROPERTIES
    static $tabRequest = [];

    // STATIC METHODS
    static function start ()
    {
        // AUTOLOAD
        // https://www.php.net/manual/fr/function.spl-autoload-register
        spl_autoload_register("App::loadClass");

        $tabCall = [
            "Dev::start",
            "Request::process",
            "View::showResponse",
        ];

        foreach($tabCall as $call)
        {
            // https://www.php.net/manual/fr/function.is-callable.php
            if (is_callable($call))
            {
                $call();
            }
        }
    }

    static function loadClass ($className)
    {
        $filePath = __DIR__ . "/$className.php";
        if (is_file($filePath))
        {
            require_once $filePath;
        }
    }

}