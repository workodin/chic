<?php
/**
 * author:  LH
 * date:    2020-04-09 16:02:04
 */


/**
 * 
 * 
 */
class TemplateGrid
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function showHtml ()
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mermaid</title>  
    <style>

html, body {
    width:100%;
    height:100%;
    padding:0;
    margin:0;
    font-size:16px;
    font-family: Verdana, Geneva, Tahoma, sans-serif, monospace;
    overflow-x: hidden; /* FIXME */
}

* {
    box-sizing: border-box;
    width:100%;
}
input[type=radio], input[type=checkbox] {
    width:2rem;    
}
header, section {
    background-color: #ffffff;
}
footer {
    text-align:center;
    padding-bottom:10rem;
}
h1, h2, h3, h4, h5, h6 {
    margin-top:0;
    text-align:center;
}
a {
    text-decoration: none;
    color:#666666;
}
p {
    padding:0.5rem;
}
article img {
    object-fit:cover;
}

input, textarea {
    padding:0.5rem;
    margin:0.5rem;
    font-size:1.2rem;
}
pre {
    white-space: pre-wrap;
    padding:1rem;
}


    /* 
    https://css-tricks.com/snippets/css/a-guide-to-flexbox/

    https://developer.mozilla.org/fr/docs/Web/CSS/CSS_Grid_Layout/Placement_automatique_sur_une_grille_CSS 
    https://developer.mozilla.org/fr/docs/Web/CSS/Requ%C3%AAtes_m%C3%A9dia/Utiliser_les_Media_queries

    240
    480
    720
    960
    1200

    */
.flexbox {
    background-color: #000000;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.flexbox > * {
    background-color: #dddddd;
    border: 1px solid #ffffff;
    margin:0.5rem;
}       

.flexbox .boxtop {
    max-height: 50vh;
    overflow: hidden;
}
.flexbox .boxtop img {
    max-height: 25vh;
}

.gridbox {
    background-color: #000000;
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1rem 1rem;
    padding: 1rem;
}  
      
.gridbox > * {
    background-color: #dddddd;
    border: 1px solid #ffffff;
}

@media screen and (min-width: 480) {
    .gridbox {
        grid-template-columns: repeat(2, 1fr);
    } 

    .flexbox > * {
        width: calc(100% / 2 - 1rem);
    }       
}

@media screen and (min-width: 720px) {
    .gridbox {
        grid-template-columns: repeat(3, 1fr);
    }        

    .flexbox > * {
        width: calc(100% / 3 - 1rem);
    }       
}

@media screen and (min-width: 960px) {
    .gridbox {
        grid-template-columns: repeat(6, 1fr);
    }        

    .flexbox > * {
        width: calc(100% / 6 - 1rem);
    }       
}

@media screen and (min-width: 1200px) {
    .gridbox {
        grid-template-columns: repeat(60, 1fr);
    }        
    .flexbox > * {
        width: calc(100% / 10 - 1rem);
    }       
}

.action {
    font-weight: 900;
    padding:0.5rem;
    text-align: center;
}
.action:hover {
    cursor:pointer;
}

/**
 * 4  5  6  8 
 * 10 12 15 
 * 20 25 
 * 30 40 50 60
 */
.listArticle article {
    grid-column-end: span 6;
}
.listArticle article.xw2 {
    grid-column-end: span 10;
}
.listArticle article.xw3 {
    grid-column-end: span 12;
}
.listArticle article.xw4 {
    grid-column-end: span 15;
}
.listArticle article.xw5 {
    grid-column-end: span 20;
}
.listArticle article.xw6 {
    grid-column-end: span 25;
}
.listArticle article.xw7 {
    grid-column-end: span 30;
}
.listArticle article.xw8 {
    grid-column-end: span 40;
}
.listArticle article.xw9 {
    grid-column-end: span 50;
}
.listArticle article.xw10 {
    grid-column-end: span 60;
}

.listArticle article.xh2 {
    grid-row-end: span 2;
}
.listArticle article.xh3 {
    grid-row-end: span 3;
}
.listArticle article.xh4 {
    grid-row-end: span 4;
}
.listArticle article.xh5 {
    grid-row-end: span 5;
}
.listArticle article.xh6 {
    grid-row-end: span 6;
}
.listArticle article.xh7 {
    grid-row-end: span 7;
}
.listArticle article.xh8 {
    grid-row-end: span 8;
}
.listArticle article.xh9 {
    grid-row-end: span 9;
}
.listArticle article.xh10 {
    grid-row-end: span 10;
}

.listArticle article {
    display:grid;
    grid-auto-flow: row dense;
    height:100%;
    grid-template-rows: auto 40px;
    justify-content: space-between;
    grid-template-areas: 
            "a  a  a  a  a"
            "b  b  b  b  b"
            "c1 c2 c3 c4 c5"
}
.listArticle article .boxtop {
    grid-area: a;
}
.listArticle article .box {
    grid-area: b;
}
.listArticle article .action.delete {
    grid-area: c1;
}
.listArticle article .action.edit {
    grid-area: c5;
}
.listArticle article .action.copy {
    grid-area: c2;
}
.listArticle article .action.moveleft {
    grid-area: c3;
}
.listArticle article .action.moveright {
    grid-area: c4;
}

.listArticle h3 {
    padding:1rem;
}

/* TOOLBAR */
.page {
    margin: 0 auto;
}
.toolbar {
    position: fixed;
    bottom: 0;
    left: 0;
    background-color: #666666;
    opacity: 0.1;
    overflow: hidden;
}
.toolbar > * {
    grid-column-end: span 4;
}

.toolbar:hover {
    opacity: 1;
}
.box.option {
    padding: 1rem; 
    position:relative;
    top:5rem;
    height:100vh;
    overflow-y:auto;
    background-color: #ffffff;   
}
    </style>
</head>
<body>
    <div id="app">

        <div class="page" :style="{width:pageW + 'px'}">

            <header>
                <a href=""><h1>{{ h1 }}</h1></a>
            </header>
            <main>
                <section class="listArticle">
                    <h2>{{ h2 }}</h2>
                    <button @click="saveArticles">save ({{ tabArticle.length }})</button>
                    <div :class="boxCss" :style="{ 'background-color' : bgcolor }">
                        <article v-for="(article, index) in tabArticleFiltre" :id="'c' + (1+index)" :class="[ 'wx1', 'i' + article.id, article.wy ? 'xh' + article.wy : 'xh1' ]" @click.ctrl="saveArticles" :style="{ 'background-color' : article.color, 'grid-column-end' : 'span ' + article.wx }">
                            <div class="boxtop">
                                <h3 contenteditable="true" v-html="article.titre" @blur="updateTitle(article, $event)"></h3>
                                <img :src="article.image" alt="article.titre" :style="{ 'height' : article.imgH + 'px' }">
                                <pre :title="article.id" contenteditable="true" :style="{ 'font-size' : article.fontSize + 'rem' }" v-text="article.contenu" @blur="updateCode(article, $event)"></pre>
                                <p>({{ article.contenu.length }} caractères)</p>
                            </div>
                            <div class="box option" v-if="article.edit">
                                <input type="text" v-model="article.titre">
                                <textarea v-model="article.contenu" rows="10" :style="{ 'font-size' : article.fontSize + 'rem' }"></textarea>
                                <input type="text" v-model="article.image">
                                <div>
                                    <span>image height ({{ article.imgH }})</span>
                                    <input type="range" v-model="article.imgH" min="100" max="1000">
                                </div>
                                <div>
                                    <span>font size</span>
                                    <span>({{ article.fontSize }})</span>
                                    <input type="range" v-model="article.fontSize" min="0.5" max="10" step="0.1">
                                </div>
                                <div>
                                    <span>color</span>
                                    <span>({{ article.color }})</span>
                                    <input type="color" v-model="article.color">
                                </div>
                                <div>
                                    <span>width ({{ article.wx }})</span>
                                    <input type="range" v-model="article.wx" min="1" max="60">
                                </div>
                                <div>
                                    <span>height</span>
                                    <span>({{ article.wy }})</span>
                                    <input type="range" v-model="article.wy" min="1" max="10">
                                </div>
                                <div>
                                    <span>move to</span>
                                    <span>({{ indexTarget }}) ({{ tabArticle[indexTarget-1].titre }})</span>
                                    <input type="range" v-model="indexTarget" min="1" :max="tabArticle.length">
                                    <button @click="moveArticle(index, indexTarget)">move to ({{ indexTarget }}) ({{ tabArticle[indexTarget-1].titre }})</button>
                                    <button v-if="index > 0" @click="moveArticle(index, index)">move left ({{ index }}) ({{ tabArticle[index-1].titre }})</button>
                                    <button v-if="tabArticle.length -1 > index" @click="moveArticle(index, index+2)">move right ({{ index+2 }}) ({{ tabArticle[index+1].titre }})</button>
                                </div>
                            </div>
                            <label class="action edit">
                                <input type="checkbox" v-model="article.edit" title="EDIT">
                                <span>#{{ 1+index }}</span>
                            </label>
                            <div class="action delete" @click="deleteArticle(index)" title="DELETE">x</div>
                            <div class="action copy" @click="copyArticle(index)" title="COPY">+</div>
                            <div class="action moveleft" @click="moveArticle(index, index)" title="MOVE LEFT">&leftarrow;</div>
                            <div class="action moveright" @click="moveArticle(index, index+2)" title="MOVE RIGHT">&rightarrow;</div>
                        </article>
                    </div>
                </section>
            </main>  
            <footer>
                <p>tous droits réservés / {{ message }}</p>
            </footer>

        </div>
        <div class="toolbar gridbox">
            <input type="text" v-model="h1">
            <input type="text" v-model="h2">
            <input type="color" v-model="bgcolor">
            <div>{{ bgcolor }}</div>
            <input type="range" v-model="pageW" min="100" :max="pageMaxW">
            <div>{{ pageW }}px</div>
            <div>
                <label>
                    <input type="radio" v-model="boxCss" value="gridbox">
                    <span>grid</span>
                </label>
                <label>
                    <input type="radio" v-model="boxCss" value="flexbox">
                    <span>flex</span>
                </label>
            </div>
            <input type="range" v-model="nbArticle" min="100" max="2000" step="100">
            <input type="number" v-model="nbArticle">
            <input type="number" v-model="textDensity">
            <button @click.prevent="resetArticles">RESET</button>
            <div>
                <input type="number" v-model="indexPage" step="50">
                <button @click.prevent="tabArticle.reverse()">REVERSE ({{ tabArticle.length }})</button>
            </div>
            <div>
                <input type="number" v-model="indexMin" step="100">
                <input type="range" v-model="indexMin" min="0" :max="tabArticle.length-1" step="100">
            </div>
            <div>
                <button @click.prevent="saveArticles">SAVE</button>
                <button @click.prevent="exportArticles">EXPORT</button>
            </div>
        </div>
    </div>
    <script src="assets/js/lz-string.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
/**
 * LIMITE A 1365 ELEMENTS DANS LE GRID ???
 */

// https://pieroxy.net/blog/pages/lz-string/index.html

// https://www.journaldunet.fr/web-tech/developpement/1203029-comment-stocker-un-objet-javascript-avec-html5-localstorage/
localSO = function(cle, objet)
{
    var texteJson = JSON.stringify(objet);
    var compressed = LZString.compress(texteJson);
    
    console.log(texteJson.length);
    console.log(compressed.length);

    localStorage.setItem(cle, compressed);
}

localGO = function(cle)
{
    var valeur = localStorage.getItem(cle);
    return valeur && JSON.parse(LZString.decompress(valeur));
}

// https://ourcodeworld.com/articles/read/189/how-to-create-a-file-and-generate-a-download-with-javascript-in-the-browser-without-a-server
function download(filename, text) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}


var app = new Vue({
    el: '#app',
    created: function(){
        var savedArticle = localGO('articles');
        if (savedArticle) {
            if ('tabArticle' in savedArticle) {
                this.tabArticle = savedArticle.tabArticle;
            }
            if ('h1' in savedArticle) {
                this.h1 = savedArticle.h1;
                document.querySelector('title').innerHTML = this.h1;
            }
            if ('h2' in savedArticle) {
                this.h2 = savedArticle.h2;
            }
            if ('bgcolor' in savedArticle) {
                this.bgcolor = savedArticle.bgcolor;
            }
            if ('indexMin' in savedArticle) {
                this.indexMin = savedArticle.indexMin;
            }
            if ('indexPage' in savedArticle) {
                this.indexPage = savedArticle.indexPage;
            }
        }
    },
    mounted: function() {
        this.pageMaxW   = document.querySelector('body').clientWidth;
//        this.pageMaxW = window.innerWidth;
        this.pageW      = this.pageMaxW;

        // activate url hash
        if (location.hash != "") {
            window.location = location.hash; //.replace('#', '');
            console.log(location.hash);
        }
    },
    computed: {
        tabArticleFiltre : function () {
            return this.tabArticle.filter((article, index) => (index >= this.indexMin) && (index < (this.indexMin + this.indexPage)) );
        }
    },
    methods: {
        updateTitle: function (article, event) {
            article.titre = event.target.innerHTML;
        },
        updateCode: function (article, event) {
            article.contenu = event.target.innerText;
        },
        exportArticles: function () {
            var articles = {};
            articles.h1 = app.h1;
            articles.h2 = app.h2;
            articles.bgcolor = app.bgcolor;
            articles.tabArticle = app.tabArticle;
            articles.indexMin = app.indexMin;
            articles.indexPage = app.indexPage;

            // Start file download.
            download("mermaid.json", JSON.stringify(articles));

        },
        resetArticles: function () {
            this.tabArticle = [];
            this.indexMin = 0;
            this.indexPage = 200;

            var tabColor = [ '#00ff80', '#ffff00', '#ff8040', '#cccccc', , '#ffffff'];
            var tabPhoto = [ '<?php echo implode("', '", glob("assets/img/*.jpg")) ?>' ];
            var lorem    = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe exercitationem molestias rerum, veritatis, voluptatibus vitae neque nam reiciendis, dolore similique illo quis magni recusandae accusantium accusamus. Dolores ea aspernatur velit.';
            var now = Date.now();
            for(var a=1; a<=this.nbArticle; a++)
            {
                var rph = Math.floor(Math.sqrt(tabPhoto.length * tabPhoto.length * Math.random()));
                var rcl = Math.floor(tabColor.length * Math.random()); 
                var rwx = Math.round(2 + 2 * Math.random());
                var rwy = Math.round(1 + 3 * Math.random());
                var rfs = 2.0 - 0.30 * Math.round(0.3 * Math.sqrt(100 * Math.random()));

                var cod = lorem;
                for(var c=0; c<rwy* this.textDensity; c++) {
                    cod += ' ' + lorem;
                }

                var jour = (1 + Math.floor((a -1) / 10));
                jour = ('' + jour).padStart(3, '0');
                var hour = 9 + ((a -1) % 10);
                hour = ('' + hour).padStart(2, '0');

                var article = { 
                        id:         now + a, 
                        titre:      'd' + jour + '-' + hour + 'h', 
                        image:      tabPhoto[rph],
                        contenu:    cod, 
                        color:      tabColor[rcl],
                        wx:         5 * rwx,
                        wy:         1 * rwy ,
                        imgH:       100 * (rwy + rwx),
                        fontSize:   rfs,
                        edit:       false
                    };
                this.tabArticle.push(article);
            }
        },
        updateWY: function(article, delta) {
            if ( ! article.wy || ! Number.isInteger(article.wy))
                article.wy = 1;

            if (delta > 0)
                article.wy = Math.min(delta + article.wy, 60);

            if (delta < 0)
                article.wy = Math.max(delta + article.wy, 1);

            console.log(article, delta);
        },
        updateWX: function(article, delta) {
            if ( ! article.wx || ! Number.isInteger(article.wx))
                article.wx = 1;

            if (delta > 0)
                article.wx = Math.min(delta + article.wx, 60);

            if (delta < 0)
                article.wx = Math.max(delta + article.wx, 1);

            console.log(article, delta);
        },
        moveArticle: function (indexSource, indexTarget) {
            var source = app.tabArticle[indexSource];
            
            app.tabArticle.splice(indexSource, 1);

            indexTarget = Math.max(indexTarget, 1);
            indexTarget = Math.min(indexTarget, app.tabArticle.length+1);

            app.tabArticle.splice(indexTarget-1, 0, source);

            location.hash = 'c' + indexTarget;
        },
        copyArticle: function (index) {
            var source = app.tabArticle[index];
            var nextArticle = Object.assign({}, source);
            // update info
            nextArticle.id = Date.now();
            nextArticle.titre = nextArticle.titre.replace(' (copy)', '') + ' (copy)';
            app.tabArticle.splice(index+1, 0, nextArticle);
        },
        deleteArticle: function (index) {
            app.tabArticle.splice(index, 1);
        },
        saveArticles: function () {
            console.log('save...');
            console.log(app.tabArticle);
            var articles = {};
            articles.h1         = app.h1;
            articles.h2         = app.h2;
            articles.bgcolor    = app.bgcolor;
            articles.tabArticle = app.tabArticle;
            articles.indexMin   = app.indexMin;
            articles.indexPage  = app.indexPage;

            localSO('articles', articles);
        }
    },
    data: {
        indexPage: 200,
        indexMin: 0,
        indexTarget: 1, 
        bgcolor: '#000000',
        tabArticle: [],
        nbArticle: 200,
        textDensity: 5,
        h1: 'titre1',
        h2: 'titre2',
        boxCss: 'gridbox',
        pageW: 1000,
        pageMaxW: 1000,
        message: 'Welcome Mermaid ;-p'
    }
});

    </script>
</body>
</html>
<?php    
    }
        
    //***/
    // STATIC METHODS END

}