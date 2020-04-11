<?php
/**
 * author:  LH
 * date:    2020-04-09 15:03:39
 */


/**
 * 
 * 
 */
class Request
{
    use BaseTrait;

    // STATIC PROPERTIES
    static $exitNow = false;
    
    // STATIC METHODS
    static function process ()
    {
        $uri = $_SERVER["REQUEST_URI"];
        // https://www.php.net/manual/fr/function.parse-url.php
        // https://www.php.net/manual/fr/function.extract.php
        extract(parse_url($uri));
        $docRoot = $_SERVER["DOCUMENT_ROOT"];
        $filePath = "$docRoot/$path";
        if (is_file($filePath))
        {
            Request::$exitNow = true;

            // https://www.php.net/manual/fr/function.mime-content-type.php
            // $ct = mime_content_type($filePath);
            // $ct = Mime::getContentType($filePath);

            // header("Content-Type: $ct");
            // readfile($filePath);
            // exit;
        }
        else
        {
            extract(pathinfo($path));

            if ($filename == "")
            {
                $filename = "index";
            }
            App::$tabRequest["filename"] = $filename;    
        }
    }
    
    static function getInput ($name, $default="")
    {
        $result = trim(strip_tags($_REQUEST[$name])) ?? $default;

        return $result;
    }    
    
    static function getApiClass ()
    {
        $apiClass = Request::getInput("apiClass");
        // https://www.php.net/manual/fr/function.preg-replace
        $apiClass = preg_replace("/[^a-zA-Z0-9]/", "", $apiClass);
        return $apiClass;
    }
    
    static function getApiMethod ()
    {
        $apiMethod = Request::getInput("apiMethod");
        // https://www.php.net/manual/fr/function.preg-replace
        $apiMethod = preg_replace("/[^a-zA-Z0-9]/", "", $apiMethod);
        return $apiMethod;
    }
    
    //***/
    // STATIC METHODS END

}