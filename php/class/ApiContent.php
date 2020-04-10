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
        Form::getText("title");
        Form::getText("category");
        Form::getText("image");
        Form::getText("code");

        if (Form::isValid())
        {
            Form::insertLine("content");
            Response::$tabData["confirmation"] = "(ApiContent::create)";
        }
        else
        {
            Response::$tabData["confirmation"] = "Erreur...";
        }
        Response::$tabData["contents"] = ApiContent::readList();
    }
        
    static function update ()
    {
        Form::getText("title");
        Form::getText("category");
        Form::getText("image");
        Form::getText("code");

        if (Form::isValid())
        {
            Form::updateLine("content");
        }
        else
        {
            Response::$tabData["confirmation"] = "Erreur...";
        }

        Response::$tabData["contents"] = ApiContent::readList();
    }

    static function read ()
    {
        // INSERT LINE
        $sql = 
        <<<CODESQL
            INSERT INTO content
            ( title, image, category, code )
            VALUES
            ( :title, :image, :category, :code )

        CODESQL;
        $now = date("H-i-s");

        $tabCV = [ 
            "title"     =>  "title-$now",
            "image"     =>  "image-$now",
            "category"  =>  "category-$now",
            "code"      =>  "code-$now",
        ];

        Model::sendSQL($sql, $tabCV);
        /*
        */

        Response::$tabData["contents"] = ApiContent::readList();
    }
    
    
    static function delete ()
    {
        Form::delete("content");

        Response::$tabData["contents"] = ApiContent::readList();
    }

    static function readList ()
    {
        $tabData = Model::read("content");
        return $tabData;
    }

    
    //***/
    // STATIC METHODS END

}