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

    static function showCrud ($params=[])
    {
?>
        <section v-if="!contentUpdate">
            <h3>CREATE user</h3>
            <form class="ajax" id="content-create" action="#content-create" method="POST">
                <input type="text" name="login" required placeholder="login">
                <input type="email" name="email" required placeholder="email">
                <input type="password" name="password" required placeholder="password">
                <button type="submit">create content</button>
                <!-- technical part -->
                <input type="hidden" name="apiClass" value="User">
                <input type="hidden" name="apiMethod" value="create">
                <div class="confirmation"></div>
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
                    <button @click="userUpdateAct(user)">update</button>
                    <button @click="userDeleteAct(user)">delete</button>
                </article>
            </div>
        </section>
<?php
    }
    
    //***/
    // STATIC METHODS END

}