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
        // OUTPUT CACHE
        // https://www.php.net/manual/fr/function.ob-start.php
        ob_start();

        // AUTOLOAD
        // https://www.php.net/manual/fr/function.spl-autoload-register
        spl_autoload_register("App::loadClass");

        $tabCall = [
            "Dev::start",
            "Request::process",
            "App::end",
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

    static function end ()
    {
        extract(App::$tabRequest);
        foreach(Theme::getSequence($filename) as $scene)
        {
            if (is_callable($scene))
            {
                $scene();
            }
        }

        // END OUTPUT CACHE
        // https://www.php.net/manual/fr/function.ob-get-clean.php
        $output = ob_get_clean();
        echo $output;
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