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
        View::$responseMode     = "json";
        Theme::$tabSequence[]   = "View/showJSON";

    }
    
    //***/
    // STATIC METHODS END

}