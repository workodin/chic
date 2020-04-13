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
        Form::getText("uri");
        Form::getText("template", "", 0);
        Form::getText("title");
        Form::getText("category");
        Form::getText("image");
        Form::getText("code");
        Form::getText("json", "", 0);

        // EXTRA CHECK
        Form::checkUnique("uri", "content");

        if (Form::isValid())
        {
            Form::insertLine("content");
            Response::$tabData["confirmation"] = "create ok";
        }
        else
        {
            Response::$tabData["confirmation"] = "Erreur...";
        }
        Response::$tabData["contents"] = ApiContent::readList();
    }
        
    static function update ()
    {
        Form::getText("uri");
        Form::getText("template", "", 0);
        Form::getText("title");
        Form::getText("category");
        Form::getText("image");
        Form::getText("code");
        Form::getText("json", "", 0);

        // FIXME
        Form::checkUniqueUpdate("content", "uri");

        if (Form::isValid())
        {
            Form::updateLine("content");
            Response::$tabData["confirmation"] = "update ok";
        }
        else
        {
            Response::$tabData["confirmation"] = "Erreur...";
        }

        Response::$tabData["contents"] = ApiContent::readList();
    }

    static function read ()
    {
        ApiContent::randomCreate();

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

    static function randomCreate ()
    {
        // INSERT LINE
        $now                = date("H-i-s");
        $publicationDate    = date("Y-m-d H:i:s");

        $tabCV = [ 
            "uri"               => "title-$now",
            "title"             => "title-$now",
            "image"             => "image-$now",
            "category"          => "index",
            "code"              => "code-$now",
            "publicationDate"   => $publicationDate,
        ];

        Model::insert("content", $tabCV);
    }
    
    //***/
    // STATIC METHODS END

}