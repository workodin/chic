<?php
/**
 * author:  LH
 * date:    2020-04-09 16:02:04
 */


/**
 * 
 * 
 */
class TemplateAdmin
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function showHtml ()
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
            <h1>ADMIN</h1>
            <nav>
                <a href="./">accueil</a>
                <a href="admin">admin</a>
            </nav>
        </header>
        <main>
            <section>
                <h2>admin</h2>
                {{ message }}
            </section>
        </main>
        <footer>
            <p>&copy;2020 - all rights reserved</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script src="assets/js/site.js"></script>
    <script>
var app = new Vue({
    el: '.page',
        data: {
        message: 'Hello Vue!'
    }
})

    </script>
</body>
</html>
<?php    
    }
        
    //***/
    // STATIC METHODS END

}