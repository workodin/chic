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
    <style>
html, body {
    width:100%;
    height:100%;
    padding:0;
    margin:0;
    font-size:16px;
}        
* {
    box-sizing: border-box;
}
form {
    padding:1rem;
    display:flex;
    flex-direction:column;
    max-width:640px;
}
form > * {
    margin:0.2rem;
    padding:0.2rem;
}
    </style>
</head>
<body>
    <div class="page">
        <header>
            <h1>My Website</h1>
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
                </form>
            </section>

            <section>
                <h2>contact</h2>
                <form class="ajax" id="contact" action="#contact" method="POST">
                    <input type="text" name="name" required placeholder="your name">
                    <input type="email" name="email" required placeholder="your email">
                    <textarea name="message" cols="60" rows="8" required placeholder="your message"></textarea>
                    <button type="submit">send message</button>
                </form>
            </section>

            <script>
function addAction(selectorCSS, eventName, callbackFunction)
{
    var listSelection = document.querySelectorAll(selectorCSS);
    listSelection.forEach(function(item) {
        item.addEventListener(eventName, callbackFunction);
    });
}

addAction("form.ajax", "submit", function(event){
    event.preventDefault();
    // DEBUG 
    console.log(event);
});
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

    //***/
    // STATIC METHODS END

}