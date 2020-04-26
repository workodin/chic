<?php
/**
 * author:  LH
 * date:    2020-04-12 13:23:05
 */


/**
 * 
 * 
 */
class TemplateNewsletter
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function showForm ($params=[])
    {
?>
            <form class="ajax" id="newsletter" action="#newsletter" method="POST">
                <input type="text" name="name" required placeholder="your name">
                <input type="email" name="email" required placeholder="your email">
                <button type="submit">subscribe</button>
                <input type="hidden" name="apiClass" value="Newsletter">
                <input type="hidden" name="apiMethod" value="subscribe">
                <div class="confirmation"></div>
            </form>
<?php        
    }
    
    
    //***/
    // STATIC METHODS END

}