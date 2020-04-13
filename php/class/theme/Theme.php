<?php
/**
 * author:  LH
 * date:    2020-04-09 15:52:53
 */


/**
 * 
 * 
 */
class Theme
{
    use BaseTrait;

    // STATIC PROPERTIES
    static $tabSequence = [];

    // STATIC METHODS
    
    static function index ()
    {
        Theme::$tabSequence[] = "View/showHeader";
        Theme::$tabSequence[] = "TemplatePublic/index";
        Theme::$tabSequence[] = "View/showFooter";
        Theme::$tabSequence[] = "Dev/showResponse";
    }
    
    
    static function admin ()
    {
        Theme::$tabSequence[] = "TemplateAdmin/showHtml";
    }
    
    
    static function api ()
    {
        Response::$mode         = "json";
        Theme::$tabSequence[]   = "Controller/processForm";
        Theme::$tabSequence[]   = "Response/showJSON";

    }
    
    
    static function error404 ($params=[])
    {
            // https://www.php.net/manual/fr/function.header.php
            header("HTTP/1.1 404 Not Found");

            Theme::$tabSequence[] = "View/showHeader";
            Theme::$tabSequence[] = "View/error404";
            Theme::$tabSequence[] = "View/showFooter";
    }
    
    static function phpinfo ($params=[])
    {
            Theme::$tabSequence[] = "View/showInfo";
    }

    //***/
    // STATIC METHODS END

}