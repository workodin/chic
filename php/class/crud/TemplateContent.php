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
        <section v-if="!modelUpdate">
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
        <section class="popup" v-show="modelUpdate" v-if="modelUpdate">
            <h3>UPDATE content</h3>
            <form class="ajax" id="content-update" action="#content-update" method="POST">
                <input type="text" name="title" required placeholder="title" v-model="modelUpdate.title">
                <input type="text" name="uri" required placeholder="uri" v-model="modelUpdate.uri">
                <input type="text" name="template" placeholder="template" v-model="modelUpdate.template">
                <input type="text" name="image" required placeholder="image" v-model="modelUpdate.image">
                <input type="text" name="category" required placeholder="category" v-model="modelUpdate.category">
                <textarea name="code" cols="60" rows="10" required placeholder="code" v-model="modelUpdate.code"></textarea>
                <textarea name="json" cols="60" rows="10" required placeholder="json" v-model="modelUpdate.json"></textarea>
                <button type="reset" @click="modelUpdate=null">cancel</button>
                <button type="submit">update content</button>
                <input type="hidden" name="id" v-model="modelUpdate.id">
                <input type="hidden" name="apiClass" value="Content">
                <input type="hidden" name="apiMethod" value="update">
                <div class="confirmation"></div>
            </form>
        </section>

        <section>
            <h3>READ content ({{ getCount('content') }})</h3>
            <form class="ajax refresh-read content-read" action="#refreshContent" method="post">
                <button type="submit">refresh content</button>
                <input type="hidden" name="apiClass" value="Content">
                <input type="hidden" name="apiMethod" value="read">
            </form>
            <div class="listArticle content mygrid">
                <article v-for="c in modelData.content" :class="[ c.category, 'content' ]">
                    <h3><a :href="c.uri">{{ c.title }} / {{ c.id }}</a></h3>
                    <h4>{{ c.uri }}</h4>
                    <h4>{{ c.template }}</h4>
                    <h4>{{ c.category }}</h4>
                    <img :src="c.image">
                    <div v-html="c.codeHtml"></div>
                    <pre>{{ c.json }}</pre>
                    <p>{{ c.publicationDate }}</p>
                    <button @click="modelUpdateAct(c)">update</button>
                    <button @click="modelDeleteAct(c, 'content')">delete</button>
                </article>
            </div>
        </section>
<?php
    }
    

    static function getAuthors ($tabContentId)
    {
        $tabContentAuthor       = [];
        $tabJoinContentAuthor   = [];

        $tabFilter = [ "table1" => "content", "tabId1" => $tabContentId ];
        $tabLink = Model::filterLink($tabFilter);
        foreach($tabLink as $link)
        {
            extract($link);
            if ($quality == "author")
            {
                if (!array_key_exists($id2, $tabContentAuthor))
                {
                    // retrieve author
                    $tabAuthor = Model::read($table2, "id", $id2);
                    foreach($tabAuthor as $userAuthor)
                    {
                        $tabContentAuthor["i-$id2"] = $userAuthor;
                    }
                }
                $tabJoinContentAuthor["i-$id1"] = "$id2";
            }
        }
        return [ "tabContentAuthor" => $tabContentAuthor, "tabJoinContentAuthor" => $tabJoinContentAuthor ];
    }

    static function showArticle ($filterC, $filterV)
    {
        $tabLine = Model::read("content", $filterC, $filterV);
       
        $tabContentId = [];
        foreach($tabLine as $tabCol)
        {
            extract($tabCol);
            // DON'T STORE TWICE THE SAME id VALUES
            $tabContentId["id-$id"] = $id;
        }

        extract(TemplateContent::getAuthors(array_values($tabContentId)));

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

            // author
            $author = "";
            if (array_key_exists("i-$id", $tabJoinContentAuthor))
            {
                $authorId   = $tabJoinContentAuthor["i-$id"];
                $author     = $tabContentAuthor["i-$authorId"]["login"] ?? "";
            }
            // $author = $tabContentAuthor[$tabJoinContentAuthor[$id] ?? "0"]["login"] ?? "";
            // $tabLink = Model::filterRead("link", [ "table1" => "content", "id1" => $id ]);
            $debug = json_encode($fgjhfkj ?? [], JSON_PRETTY_PRINT);

            echo
            <<<CODEHTML
                <article class="$category">
                    <h3 title="$id"><a href="$uri">$title</a></h3>
                    <h4>$category / ($id by $author)</h4>
                    <img src="$imageHtml">
                    <p>$publicationDate</p>
                    <div class="code">$codeHtml</div>
                    <pre>$debug<pre>
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
                <article class="$category">
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