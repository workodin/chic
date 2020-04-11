<?php
/**
 * author:  LH
 * date:    2020-04-09 15:31:12
 */


/**
 * 
 * 
 */
class Controller
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS
   
    static function processForm ()
    {
        $apiClass   = Request::getApiClass();
        $apiMethod  = Request::getApiMethod();
        if (($apiClass != "") && ($apiMethod != ""))
        {
            $apiCall    = "Api$apiClass::$apiMethod";

            if (is_callable($apiCall))
            {
                $apiCall();
            }    
        }
    }
    
    //***/
    // STATIC METHODS END

}