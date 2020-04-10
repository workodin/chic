<?php

class Dev
{
    use BaseTrait;

    // PROPERTIES
    static $tabUrlLog = [];
    static $timeStart = 0;
    static $timeEnd   = 0;

    // METHODS

    static function start ()
    {
        Dev::$timeStart = microtime(TRUE);

        App::$tabRequest["timeStart"] = date("H:i:s");

        spl_autoload_register("Dev::loadClass");

    }

    static function loadClass ($className)
    {
        $filePath = __DIR__ . "/$className.php";
        if (!is_file($filePath))
        {
            $emptyPath = __DIR__ . "/Vide.php";
            $codeClass = file_get_contents($emptyPath);
            $tabReplace = [
                "Vide"         => "$className",
                "AUTHOR"        => "LH",
                "DATECREATION"  => date("Y-m-d H:i:s"),
            ];
            $tabSearch = array_keys($tabReplace);
            $tabValue = array_values($tabReplace);
            $codeClass = str_replace($tabSearch, $tabValue, $codeClass);
            file_put_contents($filePath, $codeClass);
        }

        if (is_file($filePath))
        {
            require_once $filePath;
        }
    }

    static function showResponse ()
    {
    }

    static function step ()
    {
    }

    static function end ()
    {
    }
  
    static function log ($url="")
    {
        Dev::$timeEnd = microtime(TRUE);
        // https://www.php.net/manual/fr/function.number-format
        $deltaTime = number_format(1000 * (Dev::$timeEnd - Dev::$timeStart), 3);

        Dev::$tabUrlLog[] = "$url";
        error_log("$url [$deltaTime ms]");
    }
        
    //***/
    // STATIC METHODS END
}