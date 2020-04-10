<?php

/**
 * 
 */
class App 
{
    // no use of trait
    // as spl_autoload_register NOT ready...

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

        $tabUrl = [
            "Dev/start", 
            "Request/process",
            "App/theme",       
            "App/end",       
        ];

        App::run($tabUrl);

    }

    static function run ($tabUrl)
    {
        foreach($tabUrl as $url)
        {
            // https://www.php.net/manual/fr/function.parse-url.php
            // https://www.php.net/manual/fr/function.pathinfo.php
            // https://www.php.net/manual/fr/function.extract.php
            // https://www.php.net/manual/fr/function.parse-str.php

            extract(parse_url($url));
            extract(pathinfo($path));
            parse_str($query ?? "", $tabParam);

            // Class/method?p1=v1&p2=v2
            // Class::method([ "p1" => "v1", "p2" => "v2" ]);
            
            $call = "$dirname::$filename";
            // https://www.php.net/manual/fr/function.is-callable.php
            if (is_callable($call))
            {
                $call($tabParam ?? []);
            }
        }

    }

    static function theme ()
    {
        extract(App::$tabRequest);
        App::run(["Theme/$filename"]);
        App::run(Theme::$tabSequence);
    }

    static function end ()
    {
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