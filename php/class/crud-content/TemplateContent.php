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
                <input type="file" name="image" required placeholder="image">
                <input type="text" name="category" required placeholder="category">
                <textarea name="code" cols="60" rows="10" required placeholder="code"></textarea>
                <textarea name="json" cols="60" rows="10" required placeholder="json"></textarea>
                <button type="submit">create content</button>
                <input type="hidden" name="apiClass" value="Content">
                <input type="hidden" name="apiMethod" value="create">
                <div class="confirmation"></div>
            </form>
        </section>
        <section class="popup" v-show="contentUpdate" v-if="contentUpdate">
            <h3>UPDATE content</h3>
            <form class="ajax" id="content-update" action="#content-update" method="POST">
                <input type="text" name="title" required placeholder="title" v-model="contentUpdate.title">
                <input type="text" name="uri" required placeholder="uri" v-model="contentUpdate.uri">
                <input type="text" name="template" placeholder="template" v-model="contentUpdate.template">
                <input type="text" name="image" required placeholder="image" v-model="contentUpdate.image">
                <input type="text" name="category" required placeholder="category" v-model="contentUpdate.category">
                <textarea name="code" cols="60" rows="10" required placeholder="code" v-model="contentUpdate.code"></textarea>
                <textarea name="json" cols="60" rows="10" required placeholder="json" v-model="contentUpdate.json"></textarea>
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
            <h3>READ content ({{ contents.length }})</h3>
            <form class="ajax refresh-read content-read" action="#refreshContent" method="post">
                <button type="submit">refresh content</button>
                <input type="hidden" name="apiClass" value="Content">
                <input type="hidden" name="apiMethod" value="read">
            </form>
            <div class="listArticle contents mygrid">
                <article v-for="content in contents" :class="[ content.category, 'content' ]">
                    <h3><a :href="content.uri">{{ content.title }} / {{ content.id }}</a></h3>
                    <h4>{{ content.uri }}</h4>
                    <h4>{{ content.template }}</h4>
                    <h4>{{ content.category }}</h4>
                    <img :src="content.image">
                    <div v-html="content.codeHtml"></div>
                    <pre>{{ content.json }}</pre>
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
            // code
            $codeHtml = TemplateContent::parseCode($code);

            // image
            $imageHtml = "assets/images/chic.jpg";
            $rootdir = App::get("rootdir");
            $pathImage = "$rootdir/$image";
            if (is_file($pathImage))
            {
                $imageHtml = $image;
            }

            echo
            <<<CODEHTML
                <article>
                    <h3 title="$id"><a href="$uri">$title</a></h3>
                    <h4>$category</h4>
                    <img src="$imageHtml">
                    <p>$publicationDate</p>
                    <div class="code">$codeHtml</div>
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
            $codeHtml = TemplateContent::parseCode($code);

            // image
            $imageHtml = "assets/images/chic.jpg";
            $rootdir = App::get("rootdir");
            $pathImage = "$rootdir/$image";
            if (is_file($pathImage))
            {
                $imageHtml = $image;
            }

            echo
            <<<CODEHTML
                <article>
                    <h3 title="$id"><a href="$uri">$title</a></h3>
                    <div class="code">$codeHtml</div>
                    <h4>$category</h4>
                    <p>$imageHtml</p>
                    <p>$publicationDate</p>
                </article>
            CODEHTML;
    }
}
    
    
    static function parseCode ($code)
    {
        // PARSE CODE
        $htmlCode = "";
        $tabCode = explode("\n", $code);
        foreach($tabCode as $codeline)
        {
            $tag = substr($codeline, 0, 2);
            if ($tag != "@/")
            {
                $htmlCode .= "$codeline\n";
            }
            else
            {
                $codeline = trim(substr($codeline, 2));

                ob_start();
                App::run([ $codeline ]);
                $result = ob_get_clean();
                
                $htmlCode .= $result;
            }
        }
        return $htmlCode;
    }
    
    //***/
    // STATIC METHODS END

}