<?php
/**
 * author:  LH
 * date:    2020-04-10 17:38:01
 */


/**
 * 
 * 
 */
class Install
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function setup ($configDist, $configFile)
    {
        if (is_file($configDist))
        {
            require_once $configDist;
            // https://www.php.net/manual/fr/function.copy
            copy($configDist, $configFile);                
        }

        Model::setupDB();
    }
    
    //***/
    // STATIC METHODS END

}