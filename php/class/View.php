<?php
/**
 * author:  LH
 * date:    2020-04-09 12:21:50
 */


/**
 * 
 * 
 */
class View
{
    use BaseTrait;

    // STATIC PROPERTIES
    static $responseMode = "html";

    // STATIC METHODS
    
    
    static function showHeader ()
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/site.css">
    <style>
    </style>
</head>
<body>
    <div class="page">
        <header>
            <h1>My Website</h1>
            <nav>
                <a href="./">accueil</a>
                <a href="admin">admin</a>
            </nav>
        </header>
        <main>

<?php        
    }

    static function showFooter ()
    {
?>

        </main>
        <footer>
            <p>&copy;2020 - all rights reserved</p>
        </footer>
    </div>
</body>
</html>
<?php        
    }

    
    static function showJSON ()
    {
        $tabResponse = [];

        Controller::processForm();

        // DEBUG
        $tabResponse["timestamp"]       = date("Y-m-d H:i:s");
        $tabResponse["request"]         = $_REQUEST;
        $tabResponse["debugSQL"]        = Model::$tabDebug;

        $tabResponse += Response::getData();

        echo json_encode($tabResponse, JSON_PRETTY_PRINT);
    }
    
    
    //***/
    // STATIC METHODS END

}