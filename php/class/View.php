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
    static $prop1 = "";

    // STATIC METHODS
    static function showResponse ()
    {
        View::showHeader();
        View::showSection();
        View::showFooter();
    }
    
    
    static function showHeader ()
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="page">
        <header>
            <h1>title1</h1>
        </header>
        <main>

<?php        
    }

    static function showSection ()
    {
?>

            <section>
                <h2>title2</h2>
            </section>

<?php        
    }

    static function showFooter ()
    {
?>

        </main>
        <footer>
            <p>footer</p>
        </footer>
    </div>
</body>
</html>
<?php        
    }

    //***/
    // STATIC METHODS END

}