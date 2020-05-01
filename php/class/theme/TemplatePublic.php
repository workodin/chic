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
        extract(App::get("content", []));

?>
        <section>
            <h2>News</h2>
            <div class="listArticle mygrid">
                <?php TemplateContent::showContent() ?>
                <?php TemplateContent::showArticle("category", App::get("filename", "")) ?>
            </div>
        </section>


<?php        
    }    

    //***/
    // STATIC METHODS END

}