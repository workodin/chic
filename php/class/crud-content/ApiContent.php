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
        // CHECK USER LEVEL
        if (! Controller::checkUserLevel(100)) return;

        Form::getText("uri");
        Form::getText("template", "", 0);
        Form::getText("title");
        Form::getText("category");
        Form::getFile("image");
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
        // CHECK USER LEVEL
        if (! Controller::checkUserLevel(100)) return;

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
        // CHECK USER LEVEL
        if (! Controller::checkUserLevel(100)) return;

        ApiContent::randomCreate();

        Response::$tabData["contents"] = ApiContent::readList();
    }
    
    static function delete ()
    {
        // CHECK USER LEVEL
        if (! Controller::checkUserLevel(100)) return;

        $id = Form::getInt("id");
        $contents = Model::read("content", "id", $id);
        foreach($contents as $content)
        {
            extract($content);
            $rootdir = App::get("rootdir");
            $pathImage = "$rootdir/$image";
            if (is_file($pathImage))
            {
                // WARNING: SECURITY... DELETE FILE
                unlink($pathImage);
            }

        }

        Form::delete("content");

        Response::$tabData["contents"] = ApiContent::readList();    

    }

    static function readList ()
    {
        // CHECK USER LEVEL
        if (! Controller::checkUserLevel(100)) return;

        $tabData = Model::read("content");
        // FIXME: SHOULD PARSE code TO SEARCH AND REPLACE @/...
        $index = 0;
        foreach($tabData as $data)
        {
            extract($data);
            // code
            $codeHtml = TemplateContent::parseCode($code);{}
            $tabData[$index]["codeHtml"] = $codeHtml;

            // image
            $imageHtml = "assets/images/chic.jpg";
            $rootdir = App::get("rootdir");
            $pathImage = "$rootdir/$image";
            if (is_file($pathImage))
            {
                $imageHtml = $image;
            }
            $tabData[$index]["image"] = $imageHtml;
            $index++;

        }
                
        return $tabData;
    }

    static function randomCreate ()
    {
        // CHECK USER LEVEL
        if (! Controller::checkUserLevel(100)) return;

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