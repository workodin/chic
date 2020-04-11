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
    static $tabMethod = [];

    // MAGIC METHODS
    // https://www.php.net/manual/fr/language.oop5.overloading.php#object.callstatic
    static function __callStatic($name, $arguments)
    {
        if (!in_array($name, BaseTrait::$tabMethod))
        {
            foreach(App::$tabClassDir as $dir)
            {
                $filePath = "$dir/" . self::class . ".php";
                foreach(glob($filePath) as $fileClass)
                {
                    $codePHP = 
                    <<<CODEPHP
                    
                        static function $name (\$params=[])
                        {
                        }
                        
                        //***/
                    CODEPHP;
        
                    $codeClass = file_get_contents($fileClass);
                    $codeClass = str_replace("//***/", $codePHP, $codeClass);
                    file_put_contents($fileClass, $codeClass);
    
                    // store the method
                    BaseTrait::$tabMethod[] = $name;

                    // CHANGE ONLY ONE FILE
                    return;
                }    
    
            }
        }
    }

    // STATIC METHODS

}