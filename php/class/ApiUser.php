<?php
/**
 * author:  LH
 * date:    2020-04-11 12:47:48
 */


/**
 * 
 * 
 */
class ApiUser
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function create ($params=[])
    {
        Form::getText("login");
        Form::getText("email");
        Form::getText("password");

        if (Form::isValid())
        {
            // COMPLETE THE FORM
            Form::add("level", 10);     // 10 => ACTIVE 
            Form::add("creationDate", date("Y-m-d H:i:s"));
            
            // UPDATE THE DATA
            extract(Form::$tabCV);
            Form::add("password", password_hash($password, PASSWORD_DEFAULT));

            Form::insertLine("user");
            
            Response::$tabData["confirmation"] = "user $login ($email)";
        }
        else
        {
            Response::$tabData["confirmation"] = "Erreur...";
        }
        Response::$tabData["users"] = ApiUser::readList();
    }
    
    
    static function read ($params=[])
    {
        Response::$tabData["users"] = ApiUser::readList();
    }
    
    
    static function readList ($params=[])
    {
        $tabData = Model::read("user");
        return $tabData;
    }
    
    //***/
    // STATIC METHODS END

}