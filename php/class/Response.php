<?php
/**
 * author:  LH
 * date:    2020-04-09 15:22:07
 */


/**
 * 
 * 
 */
class Response
{
    use BaseTrait;

    // STATIC PROPERTIES
    static $tabData = [];

    // STATIC METHODS

    
    static function getData ()
    {
        return Response::$tabData;
    }
    
    //***/
    // STATIC METHODS END

}