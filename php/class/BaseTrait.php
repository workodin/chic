<?php
/**
 * author:  LH
 * date:    2020-04-09 12:30:54
 */


/**
 * 
 * 
 */
trait BaseTrait
{
    // STATIC PROPERTIES
    static $prop1 = "";

    // MAGIC METHODS
    // https://www.php.net/manual/fr/language.oop5.overloading.php#object.callstatic
    static function __callStatic($name, $arguments)
    {
        $filePath = __DIR__ . "/" . self::class . ".php";
        if (is_file($filePath))
        {
            $codePHP = 
            <<<CODEPHP
            
                static function $name ()
                {
                }
                
                //***/
            CODEPHP;

            $codeClass = file_get_contents($filePath);
            $codeClass = str_replace("//***/", $codePHP, $codeClass);
            file_put_contents($filePath, $codeClass);
        }
    }

    // STATIC METHODS
    static function doAction ()
    {

    }

}