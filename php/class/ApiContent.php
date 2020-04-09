<?php
/**
 * author:  LH
 * date:    2020-04-09 16:52:55
 */


/**
 * 
 * 
 */
class ApiContent
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function create ()
    {
        Response::$tabData["confirmation"] = "(ApiContent::create)";
        Response::$tabData["contents"] = ApiContent::readList();
    }
    
    
    static function readList ()
    {
        $tabData = [];
        $tabData[] = [ 
            "id"        => "1", 
            "title"     => "title1", 
            "image"     => "image1",
            "category"  => "category1",
            "code"      => "code1", 
        ];
        $tabData[] = [ 
            "id"        => "2", 
            "title"     => "title2", 
            "image"     => "image2",
            "category"  => "category2",
            "code"      => "code2", 
        ];
        $tabData[] = [ 
            "id"        => "3", 
            "title"     => "title3", 
            "image"     => "image3",
            "category"  => "category3",
            "code"      => "code3", 
        ];
        $tabData[] = [ 
            "id"        => "4", 
            "title"     => "title4", 
            "image"     => "image4",
            "category"  => "category4",
            "code"      => "code4", 
        ];

        return $tabData;
    }
    
    
    static function read ()
    {
        Response::$tabData["contents"] = ApiContent::readList();
    }
    
    //***/
    // STATIC METHODS END

}