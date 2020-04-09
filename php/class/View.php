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
    static function showResponse ()
    {
        extract(App::$tabRequest);
        foreach(Theme::getSequence($filename) as $scene)
        {
            if (is_callable($scene))
            {
                $scene();
            }
        }
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

    static function showSection ()
    {
?>

            <section>
                <h2>newsletter</h2>
                <form class="ajax" id="newsletter" action="#newsletter" method="POST">
                    <input type="text" name="name" required placeholder="your name">
                    <input type="email" name="email" required placeholder="your email">
                    <button type="submit">subscribe</button>
                    <input type="hidden" name="apiClass" value="Newsletter">
                    <input type="hidden" name="apiMethod" value="subscribe">
                    <div class="confirmation"></div>
                </form>
            </section>

            <section>
                <h2>contact</h2>
                <form class="ajax" id="contact" action="#contact" method="POST">
                    <input type="text" name="name" required placeholder="your name">
                    <input type="email" name="email" required placeholder="your email">
                    <textarea name="message" cols="60" rows="8" required placeholder="your message"></textarea>
                    <button type="submit">send message</button>
                    <input type="hidden" name="apiClass" value="Contact">
                    <input type="hidden" name="apiMethod" value="sendMessage">
                    <div class="confirmation"></div>
                </form>
            </section>

            <script src="assets/js/site.js"></script>
            <script>
            </script>

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
        $tabResponse["request"]         = $_REQUEST;
        $tabResponse["timestamp"]       = date("Y-m-d H:i:s");

        $tabResponse += Response::getData();

        echo json_encode($tabResponse, JSON_PRETTY_PRINT);
    }
    
    //***/
    // STATIC METHODS END

}