<?php
/**
 * author:  LH
 * date:    2020-04-11 12:36:00
 */


/**
 * 
 * 
 */
class UserTemplate
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS
    static function showLogin ($params=[])
    {
?>
        <section>
            <h2>login</h2>
            <form class="ajax" id="user-login" action="#user-login" method="POST">
                <input type="email" name="email" required placeholder="email">
                <input type="password" name="password" required placeholder="password">
                <button type="submit">login</button>
                <!-- technical part -->
                <input type="hidden" name="apiClass" value="User">
                <input type="hidden" name="apiMethod" value="login">
                <div class="confirmation"></div>
            </form>   
        </section>
<?php
        $codeJS =
<<<CODEJS
chic.pageSetup = function () {
    chic.userCB.login = function (data) {
        var objetJSON = data.json;
        if ('token' in objetJSON) {
            sessionStorage.setItem('token', objetJSON.token);
        }
        if ('token2' in objetJSON) {
            sessionStorage.setItem('token2', objetJSON.token2);
        }
        if ('redirect' in objetJSON) {
            window.location = objetJSON.redirect;
        }
    }
};
CODEJS;
        App::set("script", $codeJS);
    }

    static function showCrud ($params=[])
    {
?>
        <section v-if="!contentUpdate">
            <h3>CREATE user</h3>
            <form class="ajax" id="content-create" action="#content-create" method="POST">
                <input type="text" name="login" required placeholder="login">
                <input type="email" name="email" required placeholder="email">
                <input type="password" name="password" required placeholder="password">
                <button type="submit">create user</button>
                <!-- technical part -->
                <input type="hidden" name="apiClass" value="User">
                <input type="hidden" name="apiMethod" value="create">
                <div class="confirmation"></div>
            </form>
        </section>
        <section class="popup" v-show="userUpdate" v-if="userUpdate">
            <h3>UPDATE user</h3>
            <form class="ajax" id="user-update" action="#user-update" method="POST">
                <input type="text" name="login" required placeholder="title" v-model="userUpdate.login">
                <input type="text" name="email" required placeholder="email" v-model="userUpdate.email">
                <input type="text" name="level" placeholder="level" v-model="userUpdate.level">
                <input type="password" name="password" required placeholder="password">
                <button type="reset" @click="userUpdate=null">cancel</button>
                <button type="submit">update user</button>
                <input type="hidden" name="id" v-model="userUpdate.id">
                <input type="hidden" name="apiClass" value="User">
                <input type="hidden" name="apiMethod" value="update">
                <div class="confirmation"></div>
            </form>
        </section>
        <section class="noshow">
            <h3>DELETE user</h3>
            <form class="ajax user-delete" action="#user-delete" method="post">
                <button type="submit">delete user</button>
                <input type="number" name="id">
                <input type="hidden" name="apiClass" value="User">
                <input type="hidden" name="apiMethod" value="delete">
            </form>
        </section>
        <section>
            <h3>READ user</h3>
            <form class="ajax refresh-read user-read" action="#user-read" method="post">
                <button type="submit">refresh user</button>
                <input type="hidden" name="apiClass" value="User">
                <input type="hidden" name="apiMethod" value="read">
            </form>
            <div class="listArticle users">
                <article v-for="user in users" class="user">
                    <h3>{{ user.login }} / {{ user.level }} / {{ user.email }} / {{ user.id }}</h3>
                    <div :title="user.password">{{ user.password }}</div>
                    <button @click="userUpdateAct(user)">update</button>
                    <button @click="userDeleteAct(user)">delete</button>
                </article>
            </div>
        </section>
<?php
    }
    
    
    static function showLogout ($params=[])
    {
        $codeJS =
<<<CODEJS
chic.pageSetup = function () {
    // remove tokens
    sessionStorage.setItem('token', '');
    sessionStorage.setItem('token2', '');
    // reset
    sessionStorage.clear();
    // redirect
    window.location = 'login';
};
CODEJS;
        App::set("script", $codeJS);
    }
    
    //***/
    // STATIC METHODS END

}