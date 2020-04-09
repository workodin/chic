<?php
/**
 * author:  LH
 * date:    2020-04-09 15:17:57
 */


/**
 * 
 * 
 */
class ApiContact
{
    use BaseTrait;

    // STATIC PROPERTIES
    static $prop1 = "";

    // STATIC METHODS
    
    static function sendMessage ()
    {
        Response::$tabData["confirmation"] = "(ApiContact::sendMessage)";
    }
    
    //***/
    // STATIC METHODS END

}