<?php

/**
 * 
 */
class App 
{
    // no use of trait
    // as spl_autoload_register NOT ready...

    // STATIC PROPERTIES
    static $tabRequest  = [];
    static $tabKV       = [];
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

        $result = App::run(App::$tabUrl);

        return $result;
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

            // FIXME: PERFORMANCE ?
            // https://www.php.net/manual/fr/function.is-callable.php
            if (is_callable($call))
            {
                // DYNAMIC CALL STATIC METHOD
                App::$tabKV["$call"] = $call($tabParam ?? []);

                Dev::log($url);
                if (Request::$exitNow)
                {
                    return false;
                }
            }
        }

    }

    static function get ($key, $default="")
    {
        return App::$tabKV[$key] ?? $default;
    }

    static function set ($key, $value)
    {
        return App::$tabKV[$key] = $value;
    }

    static function show ($key, $default="")
    {
        echo App::$tabKV[$key] ?? $default;
    }

    static function theme ()
    {
        extract(App::$tabRequest);
        // DON'T GENERATE METHOD FOR EVERY URI...
        // https://www.php.net/manual/fr/function.method-exists.php
        if (method_exists("Theme", $filename))
        {
            App::run(["Theme/$filename"]);
        }
        elseif (method_exists("Theme", "error404"))
        {
            // https://www.php.net/manual/fr/function.header.php
            header("HTTP/1.1 404 Not Found");
            App::run(["Theme/error404"]);
        }
        else
        {
            // https://www.php.net/manual/fr/function.header.php
            header("HTTP/1.1 404 Not Found");

            Theme::$tabSequence[] = "View/showHeader";
            Theme::$tabSequence[] = "View/error404";
            Theme::$tabSequence[] = "View/showFooter";
        }

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