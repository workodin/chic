<?php
/**
 * author:  LH
 * date:    2020-04-09 15:16:33
 */


/**
 * 
 * 
 */
class ApiNewsletter
{
    use BaseTrait;

    // STATIC PROPERTIES
    static $prop1 = "";

    // STATIC METHODS
    
    static function subscribe ()
    {
        Response::$tabData["confirmation"] = "(ApiNewsletter::subscribe)";
    }
    
    //***/
    // STATIC METHODS END

}