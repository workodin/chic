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
    static $tabClassDir = [
        __DIR__,
        __DIR__ . "/*/",
    ];
    static $tabUrl = [
        "Dev/start", 
        "Request/process",
        "App/theme",       
        "App/end", 
        "Dev/end", 
    ];

    // STATIC METHODS
    static function start ()
    {
        // OUTPUT CACHE
        // https://www.php.net/manual/fr/function.ob-start.php
        ob_start();

        // AUTOLOAD
        // https://www.php.net/manual/fr/function.spl-autoload-register
        spl_autoload_register("App::loadClass");

        App::run(App::$tabUrl);

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

            $dirname    = trim($dirname);
            $filename   = trim($filename);

            $call = "$dirname::$filename";
            // https://www.php.net/manual/fr/function.is-callable.php
            if (is_callable($call))
            {
                $call($tabParam ?? []);

                Dev::log($url);

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
        foreach(App::$tabClassDir as $dir)
        {
            $filePath = "$dir/$className.php";
            foreach (glob($filePath) as $classFile)
            {
                require_once $classFile;
            }
    
        }
    }

}