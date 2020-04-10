<?php
/**
 * author:  LH
 * date:    2020-04-10 17:38:01
 */


/**
 * 
 * 
 */
class Install
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function setup ()
    {
        Model::setupDB();
    }
    
    //***/
    // STATIC METHODS END

}