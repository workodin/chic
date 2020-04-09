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
                <a href="#a-admin" @click="page='a'">admin A</a>
                <a href="#b-admin" @click="page='b'">admin B</a>
                <a href="#c-admin" @click="page='c'">admin C</a>
            </nav>
        </header>
        <main>
            <section>
                <h2>admin</h2>                
            </section>

            <section v-if="page=='a'">
                <h2>ADMIN A</h2>
            </section>

            <section v-if="page=='b'">
                <h2>ADMIN B</h2>
            </section>

            <section v-if="page=='c'">
                <h2>ADMIN C</h2>
            </section>

        </main>
        <footer>
            <p>&copy;2020 - all rights reserved</p>
            <p>{{ message }}</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script src="assets/js/site.js"></script>
    <script>
var app = new Vue({
    el: '.page',
        data: {
            page: 'a',    
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