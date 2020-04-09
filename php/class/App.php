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

        // https://www.php.net/manual/fr/function.is-callable.php
        if (is_callable("Dev::start"))
        {
            Dev::start();
        }

        App::processRequest();
        App::buildResponse();

    }

    static function loadClass ($className)
    {
        $filePath = __DIR__ . "/$className.php";
        if (is_file($filePath))
        {
            require_once $filePath;
        }
    }

    static function processRequest ()
    {
        $uri = $_SERVER["REQUEST_URI"];
        // https://www.php.net/manual/fr/function.parse-url.php
        // https://www.php.net/manual/fr/function.extract.php
        extract(parse_url($uri));
        extract(pathinfo($path));

        App::$tabRequest["filename"] = $filename;
    }

    static function buildResponse ()
    {
        View::showResponse();

        if (is_callable("Dev::showResponse"))
        {
            Dev::showResponse();
        }

    }
}