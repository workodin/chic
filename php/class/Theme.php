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

    
    static function getSequence ($filename)
    {
        $call = "Theme::$filename";
        if (is_callable($call))
        {
            $call();
        }
        return Theme::$tabSequence;
    }
    
    
    static function index ()
    {
        Theme::$tabSequence[] = "View::showHeader";
        Theme::$tabSequence[] = "View::showSection";
        Theme::$tabSequence[] = "View::showFooter";
        Theme::$tabSequence[] = "Dev::showResponse";
    }
    
    
    static function admin ()
    {
        Theme::$tabSequence[] = "TemplateAdmin::showHtml";
    }
    
    
    static function api ()
    {
        View::$responseMode     = "json";
        Theme::$tabSequence[]   = "View::showJSON";

    }
    
    //***/
    // STATIC METHODS END

}