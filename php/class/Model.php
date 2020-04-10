<?php
/**
 * author:  LH
 * date:    2020-04-10 11:29:41
 */


/**
 * 
 * 
 */
class Model
{
    use BaseTrait;

    // STATIC PROPERTIES
    static $pdo = null;

    // STATIC METHODS

    
    static function showArticle ()
    {
        $tabLine = Model::read("content");
        foreach($tabLine as $tabCol)
        {
            extract($tabCol);
            echo
            <<<CODEHTML
                <article>
                    <h3 title="$id">$title</h3>
                    <h4>$category</h4>
                    <p>$image</p>
                    <pre>$code</pre>
                </article>
            CODEHTML;
        }        
    }
    
    
    static function read ($tableName)
    {

        $sql = 
        <<<CODESQL
            SELECT * 
            FROM '$tableName'
            ORDER BY id DESC
        CODESQL;

        $pdoStatement = Model::sendSQL($sql);

        $tabLine = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $tabLine;
   }
    
    
    static function connectDB ()
    {
        if (Model::$pdo == null)
        {
            try 
            {
                $appDir = realpath(__DIR__ . "/../../app");
                $dbPath = "$appDir/data.db";
    
                Model::$pdo = new PDO("sqlite:$dbPath");

                Model::setupDB();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }    
        }

        return Model::$pdo;
    }
    
    
    static function setupDB ()
    {
        // CREATE TABLES
        $tablePath = "$appDir/tables.sqlite";
        $sqlTables = file_get_contents($tablePath);
        Model::sendSQL($sqlTables);

        // INSERT LINE
        $sql = 
        <<<CODESQL
            INSERT INTO content
            ( title, image, category, code )
            VALUES
            ( :title, :image, :category, :code )

        CODESQL;
        $now = date("H-i-s");

        $tabCV = [ 
            "title"     =>  "title-$now",
            "image"     =>  "image-$now",
            "category"  =>  "category-$now",
            "code"      =>  "code-$now",
        ];

        Model::sendSQL($sql, $tabCV);
    }
    
    
    static function sendSQL ($sql, $tabCV=[])
    {
        try 
        {
            $pdo = Model::connectDB();
            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->execute($tabCV);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }

        return $pdoStatement;
    }
    
    //***/
    // STATIC METHODS END

}