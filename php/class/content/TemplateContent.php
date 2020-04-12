<?php
/**
 * author:  LH
 * date:    2020-04-09 16:38:06
 */


/**
 * 
 * 
 */
class TemplateContent
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function showCrud ()
    {
?>
        <section v-if="!contentUpdate">
            <h3>CREATE content</h3>
            <form class="ajax" id="content-create" action="#content-create" method="POST">
                <input type="text" name="title" required placeholder="title">
                <input type="text" name="uri" required placeholder="uri">
                <input type="text" name="template" placeholder="template">
                <input type="text" name="image" required placeholder="image">
                <input type="text" name="category" required placeholder="category">
                <textarea name="code" cols="60" rows="10" required placeholder="code"></textarea>
                <button type="submit">create content</button>
                <input type="hidden" name="apiClass" value="Content">
                <input type="hidden" name="apiMethod" value="create">
                <div class="confirmation"></div>
            </form>
        </section>
        <section class="popup" v-show="contentUpdate" v-if="contentUpdate">
            <h3>UPDATE content</h3>
            <form @submit.prevent="contentUpdateSave" class="ajax" id="content-update" action="#content-update" method="POST">
                <input type="text" name="title" required placeholder="title" v-model="contentUpdate.title">
                <input type="text" name="uri" required placeholder="uri" v-model="contentUpdate.uri">
                <input type="text" name="template" placeholder="template" v-model="contentUpdate.template">
                <input type="text" name="image" required placeholder="image" v-model="contentUpdate.image">
                <input type="text" name="category" required placeholder="category" v-model="contentUpdate.category">
                <textarea name="code" cols="60" rows="10" required placeholder="code" v-model="contentUpdate.code"></textarea>
                <button type="reset" @click="contentUpdate=null">cancel</button>
                <button type="submit">update content</button>
                <input type="hidden" name="id" v-model="contentUpdate.id">
                <input type="hidden" name="apiClass" value="Content">
                <input type="hidden" name="apiMethod" value="update">
                <div class="confirmation"></div>
            </form>
        </section>
        <section class="noshow">
            <h3>DELETE content</h3>
            <form class="ajax content-delete" action="#content-delete" method="post">
                <button type="submit">delete content</button>
                <input type="number" name="id">
                <input type="hidden" name="apiClass" value="Content">
                <input type="hidden" name="apiMethod" value="delete">
            </form>
        </section>
        <section>
            <h3>READ content</h3>
            <form class="ajax refresh-read content-read" action="#refreshContent" method="post">
                <button type="submit">refresh content</button>
                <input type="hidden" name="apiClass" value="Content">
                <input type="hidden" name="apiMethod" value="read">
            </form>
            <div class="listArticle contents">
                <article v-for="content in contents" class="content">
                    <h3><a :href="content.uri">{{ content.title }} / {{ content.id }}</a></h3>
                    <h4>{{ content.uri }}</h4>
                    <h4>{{ content.template }}</h4>
                    <h4>{{ content.category }}</h4>
                    <p>{{ content.image }}</p>
                    <pre>{{ content.code }}</pre>
                    <p>{{ content.publicationDate }}</p>
                    <button @click="contentUpdateAct(content)">update</button>
                    <button @click="contentDeleteAct(content)">delete</button>
                </article>
            </div>
        </section>
<?php
    }
    
    static function showArticle ($filterC, $filterV)
    {
        $tabLine = Model::read("content", $filterC, $filterV);

        foreach($tabLine as $tabCol)
        {
            extract($tabCol);
            echo
            <<<CODEHTML
                <article>
                    <h3 title="$id"><a href="$uri">$title</a></h3>
                    <h4>$category</h4>
                    <p>$image</p>
                    <p>$publicationDate</p>
                    <pre>$code</pre>
                </article>
            CODEHTML;
        }        
    }
    

    
    static function showContent ($params=[])
    {
        $tabCol = App::get("content", []);
        if (!empty($tabCol))
        {
            extract($tabCol);
            echo
            <<<CODEHTML
                <article>
                    <h3 title="$id"><a href="$uri">$title</a></h3>
                    <h4>$category</h4>
                    <p>$image</p>
                    <p>$publicationDate</p>
                    <pre>$code</pre>
                </article>
            CODEHTML;
    }
}
    
    //***/
    // STATIC METHODS END

}