<?php

class Dev
{
    use BaseTrait;

    static function start ()
    {
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
        extract(App::$tabRequest);

        echo 
        <<<OUT
        ($timeStart)
        ($filename)
        OUT;

    }

    //***/
    // STATIC METHODS END
}