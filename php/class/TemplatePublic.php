<?php
/**
 * author:  LH
 * date:    2020-04-09 16:15:07
 */


/**
 * 
 * 
 */
class TemplatePublic
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function index ()
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

        <section>
            <h2>blog</h2>
            <div class="listArticle">
                <?php Model::showArticle() ?>
            </div>
        </section>

        <script src="assets/js/site.js"></script>
        <script>
addAjaxForm();
        </script>

<?php        
    }
    
    //***/
    // STATIC METHODS END

}