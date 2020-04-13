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

    static function getText ($inputName, $default="", $minLength=1)
    {
        $data = Request::getInput($inputName, $default);
        $nbChar = mb_strlen($data);
        if ($nbChar < $minLength)
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
    
    static function getFile ($inputName, $default="")
    {
        $data = Request::getFile($inputName, $default);

        // store for later use in SQL
        Form::$tabCV[$inputName] = $data;

        return $data;
    }    
    
    static function delete ($tableName)
    {
        $id = Form::getInt("id");
        Model::deleteId($tableName, $id);
    }

        
    
    static function updateLine ($tableName)
    {
        $id = Form::getInt("id");
        Model::UpdateId($tableName, Form::$tabCV, $id);
    }
    
    
    static function add ($inputName, $data)
    {
        Form::$tabCV[$inputName] = $data;
    }

    static function remove ($inputName)
    {
        // https://www.php.net/manual/fr/function.unset.php
        unset(Form::$tabCV[$inputName]);
    }

    
    static function checkUnique ($col, $tableName)
    {
        $search = Form::$tabCV[$col];
        $founds = Model::read($tableName, $col, $search);
        if (count($founds) > 0)
        {
            Form::$tabError[] = "$search is not available";
        }

    }
    
    
    static function getEmail ($inputName)
    {
        $data = Form::getText($inputName);
        if ($data != filter_var($data, FILTER_VALIDATE_EMAIL))
        {
            Form::$tabError[] = "invalid email ($data)";
        }
        return $data;
    }
    
    
    static function checkUniqueUpdate ($tableName, $colName)
    {
        $colVal     = Form::$tabCV[$colName] ?? "";
        $tabLigne   = Model::read($tableName, $colName, $colVal);
        foreach ($tabLigne as $tabCV)
        {
            // FOUND ONE LINE SHOULD BE THE SAME AS ONGOING UPDATE
            $id = Form::getInt("id");
            if ($id != $tabCV["id"])
            {
                Form::$tabError[] = "uri is not available";
            }
        }
    }
        
    //***/
    // STATIC METHODS END

}