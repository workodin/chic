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

    // STATIC METHODS
    
    
    static function showHeader ()
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Website">
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
                <a href="login">login</a>
                <a href="admin">admin</a>
                <a href="logout">logout</a>
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
    <script>

var initPageCB = function ()
{
    // LET THE PAGE ADD EXTRA JS
    <?php App::show("script") ?>

    if ('pageSetup' in chic) chic.pageSetup();

    chic.addAjaxForm();
}

    </script>
    <script defer src="assets/js/site.js"></script>
</body>
</html>
<?php        
    }    
        
    static function error404 ($params=[])
    {
?>
        <section>
            <h2>ERROR 404</h2>
        </section>
<?php        
    }
          
    
    static function showInfo ($params=[])
    {
        phpinfo();
    }
    
    //***/
    // STATIC METHODS END

}