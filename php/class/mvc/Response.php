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
    static $mode = "html";

    // STATIC METHODS

    
    static function getData ()
    {
        return Response::$tabData;
    }

    static function showJSON ()
    {
        $tabResponse = [];

        // DEBUG
        $tabResponse["timestamp"]       = date("Y-m-d H:i:s");
        $tabResponse["request"]         = $_REQUEST;
        $tabResponse["debugSQL"]        = Model::$tabDebug;

        $tabResponse += Response::getData();

        echo json_encode($tabResponse, JSON_PRETTY_PRINT);
    }
    
    //***/
    // STATIC METHODS END

}