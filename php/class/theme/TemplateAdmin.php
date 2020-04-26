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
    <title>My Admin</title>
    <link rel="stylesheet" href="assets/css/site.css">
    <style>
    </style>
</head>
<body>
    <div class="app">
        <div class="page noshow">
            <header>
                <h1>ADMIN</h1>
                <nav>
                    <a href="./">accueil</a>
                    <a href="#a-admin" @click="page='a'">admin A</a>
                    <a href="#b-admin" @click="page='b'">admin B</a>
                    <a href="#c-admin" @click="page='c'">admin C</a>
                    <a href="logout">logout</a>
                </nav>
            </header>
            <main>
                <section>
                    <h2>admin</h2>                
                </section>

                <section v-if="page=='a'">
                    <h2>ADMIN A</h2>
                    <?php TemplateContent::showCrud() ?>
                </section>

                <section v-if="page=='b'">
                    <h2>ADMIN B</h2>
                    <?php UserTemplate::showCrud() ?>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script src="assets/js/site.js"></script>
    <script>
chic.userCB.test = function(data)
{
    console.log('test');
    console.log(data);
}

var app = new Vue({
    el: '.app',
    beforeCreate: function () {
        token   = sessionStorage.getItem('token');
        token2  = sessionStorage.getItem('token2');
        console.log(token);
        if (!token)
        {
            window.location = 'login';
        }
        else
        {
            chic.extraFormData = {
                'token': token,
                'token2': token2,
            };
            document.querySelectorAll('.page.noshow').forEach(function(item) { 
                item.classList.remove('noshow')
            });

        }
    },
    mounted: function (){
        chic.userCB.jsonCB = this.jsonCB;
        addAjaxForm();
        this.refreshRead();
    },
    updated: function () {
        addAjaxForm();
        this.refreshRead();
    },
    methods: {
        refreshRead: function () {
            // WARNING: doesn't work with 
            // document.querySelector("form.content-read").submit();
            document
            .querySelectorAll("form.refresh-read")
            .forEach(function(item) {
                item.classList.remove("refresh-read");
                item.classList.add("refresh-ready"); 
                var btn = item.querySelector("button[type=submit]");
                if (btn) btn.click();
            });
        },
        jsonCB: function(data){
            var jsonObject = data.json;
            if ('contents' in jsonObject)
            {
                app.contents = jsonObject.contents;
            }
            if ('users' in jsonObject)
            {
                app.users = jsonObject.users;
            }
        },
        // user
        userDeleteAct: function (user) {
            console.log(user.id);
            document.querySelector('form.user-delete input[name=id]').value = user.id;
            document.querySelector('form.user-delete button[type=submit]').click();
        },
        modelUpdateAct: function (model) {
            // ATTENTION: DOESN'T COPY THE DATA
            // app.modelUpdate = content; 
            // COPY THE DATA
            app.modelUpdate = Object.assign({}, model);
        },
        contentDeleteAct: function (content) {
            console.log(content.id);
            document.querySelector('form.content-delete input[name=id]').value = content.id;
            document.querySelector('form.content-delete button[type=submit]').click();
        },
    },
    data: {
        modelUpdate: null,
        // user
        users: [],
        // content
        contents: [],
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