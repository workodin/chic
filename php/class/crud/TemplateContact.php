<?php
/**
 * author:  LH
 * date:    2020-04-12 13:24:05
 */


/**
 * 
 * 
 */
class TemplateContact
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function showForm ($params=[])
    {
?>
            <form class="ajax" id="contact" action="#contact" method="POST">
                <label>
                    <span>your name</span>
                    <input type="text" name="name" required placeholder="your name">
                </label>
                <label>
                    <span>your email</span>
                    <input type="email" name="email" required placeholder="your email">
                </label>
                <label>
                    <span>your message</span>
                    <textarea name="message" cols="60" rows="8" required placeholder="your message"></textarea>
                </label>
                <button type="submit">send message</button>
                <input type="hidden" name="apiClass" value="Contact">
                <input type="hidden" name="apiMethod" value="sendMessage">
                <div class="confirmation"></div>
            </form>
<?php
    }
    
    
    //***/
    // STATIC METHODS END

}