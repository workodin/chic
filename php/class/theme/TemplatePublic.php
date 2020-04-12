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
            <div class="listArticle">
                <?php TemplateContent::showContent() ?>
                <?php TemplateContent::showArticle("category", App::get("filename", "")) ?>
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