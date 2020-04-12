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
    static $pdo         = null;
    static $tabDebug    = [];

    // STATIC METHODS    
    
    static function read ($tableName, $col="", $search="")
    {
        $tabCV = [];
        $listWhere = "";
        if ($col != "")
        {
            $listWhere = "WHERE $col = :$col";
            $tabCV[$col] = $search;
        }
        
        $sql = 
        <<<CODESQL
            SELECT * 
            FROM '$tableName'
            $listWhere
            ORDER BY id DESC
        CODESQL;

        $pdoStatement = Model::sendSQL($sql, $tabCV);

        $tabLine = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $tabLine;
   }
    
    
    static function connectDB ()
    {
        if (Model::$pdo == null)
        {
            try 
            {
                Model::$pdo = new PDO(Config::$dsn);
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

        // https://www.php.net/manual/fr/function.realpath
        // FIXME: BETTER ROOT FOLDER MANAGEMENT
        $docroot    = $_SERVER["DOCUMENT_ROOT"];
        $appDir     = realpath("$docroot/../app");
        $setupPath  = "$appDir/setup-*.sqlite";
        
        // https://www.php.net/manual/fr/function.glob.php
        $tabSetupSQL = glob($setupPath);
        foreach($tabSetupSQL as $setupSQL)
        {
            $sqlCode = file_get_contents($setupSQL);
            Model::sendSQL($sqlCode);    
        }
    }
    
    
    static function sendSQL ($sql, $tabCV=[])
    {
        ob_start();
        
        try 
        {
            // echo "$sql";
            // print_r($tabCV);

            $pdo = Model::connectDB();
            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->execute($tabCV);

            // DEBUG
            $pdoStatement->debugDumpParams();
        }
        catch(Exception $e)
        {
            error_log($e->getMessage());
        }

        $log = ob_get_clean();
        Model::$tabDebug[] = $log;
        Dev::log($log);

        return $pdoStatement;
    }
    
    
    static function insert ($tableName, $tabCV)
    {
        $listColumn = "";
        $listToken  = "";
        $count      = 0;
        foreach($tabCV as $key => $value)
        {
            if ($count == 0)
            {
                $listColumn .= "$key";
                $listToken  .= ":$key";
            }
            else
            {
                $listColumn .= " ,$key";
                $listToken  .= " ,:$key";
            }
            $count++;
        }
        
        $sqlPrepared = 
        <<<CODESQL
        INSERT INTO $tableName
        ( $listColumn )
        VALUES
        ( $listToken )
        CODESQL;

        Model::sendSQL($sqlPrepared, $tabCV);
    }
    
    
    static function delete ($tableName, $tabCV)
    {
        $listWhere = "";
        $count      = 0;
        foreach($tabCV as $key => $value)
        {
            if ($count == 0)
            {
                $listWhere .= "$key = :$key";
            }
            else
            {
                $listWhere .= " AND $key = :$key";
            }
            $count++;
        }

        $sqlPrepared = 
        <<<CODESQL
        DELETE FROM $tableName
        WHERE
        $listWhere
        CODESQL;

        Model::sendSQL($sqlPrepared, $tabCV);

    }
    
        
    
    static function deleteId ($tableName, $id)
    {
        $id = intval($id);
        if ($id > 0)
        {
            $sqlPrepared = 
            <<<CODESQL
            DELETE FROM $tableName
            WHERE
            id = '$id'
            CODESQL;
    
            Model::sendSQL($sqlPrepared);    
        }
    }
    
    
    static function UpdateId ($tableName, $tabCV, $id)
    {
        $id = intval($id);
        if ($id > 0)
        {
            $listCol = "";
            $count      = 0;
            foreach($tabCV as $key => $value)
            {
                if ($count == 0)
                {
                    $listCol .= "$key = :$key";
                }
                else
                {
                    $listCol .= " ,$key = :$key";
                }
                $count++;
            }

            $sqlPrepared = 
            <<<CODESQL
            UPDATE $tableName
            SET
            $listCol
            WHERE
            id = '$id'
            CODESQL;
    
            Model::sendSQL($sqlPrepared, $tabCV);    
        }
    }
    
    //***/
    // STATIC METHODS END

}