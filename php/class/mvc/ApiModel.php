<?php
/**
 * author:  LH
 * date:    2020-04-26 15:59:18
 */


/**
 * 
 * 
 */
class ApiModel
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function delete ()
    {
        // CHECK USER LEVEL
        if (! Controller::checkUserLevel(100)) return;

        $table  = Form::getUri("table");
        $id     = Form::getInt("id");

        Form::delete($table);

        // https://www.php.net/manual/fr/function.ucfirst.php
        $className = ucfirst($table);
        $callDelete = "Api$className/delete";
        App::run([ $callDelete ]);

        $callRead = "Api$className::readList";  
        if (is_callable($callRead))
        {
            Response::$tabData[$table] = $callRead();
        }
            
    }


    //***/
    // STATIC METHODS END

}