<?php
/**
 * author:  LH
 * date:    2020-04-10 14:33:52
 */


/**
 * 
 * 
 */
class Form
{
    use BaseTrait;

    // STATIC PROPERTIES
    static $tabCV       = [];
    static $tabError    = [];

    // STATIC METHODS

    static function getText ($inputName, $default="")
    {
        $data = Request::getInput($inputName, $default);
        $nbChar = mb_strlen($data);
        if ($nbChar == 0)
        {
            Form::$tabError[] = "$inputName IS MANDATORY";
        }

        // store for later use in SQL
        Form::$tabCV[$inputName] = $data;

        return $data;
    }    
    
    
    static function isValid ()
    {
        return (0 == count(Form::$tabError));
    }
    
    
    static function insertLine ($tableName)
    {
        Model::insert($tableName, Form::$tabCV);
    }
    
    
    static function getInt ($inputName, $default="")
    {
        $data = Request::getInput($inputName, $default);
        $data = intval($data);

        // store for later use in SQL
        Form::$tabCV[$inputName] = $data;

        return $data;
    }    
    
    
    static function delete ($tableName)
    {
        $id = Form::getInt("id");
        Model::deleteId($tableName, $id);
    }

        
    //***/
    // STATIC METHODS END

}