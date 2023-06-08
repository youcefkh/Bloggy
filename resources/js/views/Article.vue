<template>
    <div v-if="loading" class="text-center loading">{{$t('loading')}}</div>
    <div v-else>
        <nav class="breadcrumb" role="navigation" aria-label="Vous êtes ici :">
            <div class="container">
                <p class="breadcrumb-list">
                    <span
                        ><a href="#">{{ category }}</a></span
                    ><span class="breadcrumb-separator"> &nbsp;&gt; </span>
                    <span
                        ><a href="#">{{ subcategory }}</a
                        ><span class="breadcrumb-separator"> &nbsp;&gt; </span>
                    </span>
                    <strong class="active" aria-current="page">
                        {{ articleTitle }}
                    </strong>
                </p>
            </div>
        </nav>
        <div class="container main-container">
            <div class="col-art">
                <article class="article fiche">
                    <div class="actu">
                        <header>
                            <div class="toolbar toolbar-top" id="toolbartop">
                                <div class="toolbar-share">
                                    <div class="toolbar-share-list">
                                        <ul class="small-icons">
                                            <!-- <li>
                                                <button @click="downloadPDF">
                                                    <span
                                                        aria-hidden="true"
                                                        class="icon icon-download-doc"
                                                    ></span
                                                    ><span
                                                        class="blank"
                                                        rel="noopener noreferrer"
                                                        >Télécharger au format
                                                        pdf</span
                                                    >
                                                </button>
                                                <VueHtml2pdf
                                                    :manual-pagination="true"
                                                    :enable-download="true"
                                                    ref="DownloadComp"
                                                >
                                                    <section slot="pdf-content">
                                                        <h1>test</h1>
                                                    </section>
                                                </VueHtml2pdf>
                                            </li> -->
                                            <li>
                                                <button
                                                    class="btn-print"
                                                    title="Imprimer"
                                                    @click="printPage"
                                                    data-xiti-name="Partage::Imprimer::Particuliers::Actualite"
                                                    data-xiti-type="action"
                                                >
                                                    <span
                                                        aria-hidden="true"
                                                        class="icon icon-print"
                                                    ></span
                                                    ><span
                                                        class="blank"
                                                        rel="noopener noreferrer"
                                                        >Imprimer</span
                                                    >
                                                </button>
                                            </li>
                                            <li>
                                                <ShareNetwork
                                                    network="facebook"
                                                    :url="url"
                                                    :title="article.title"
                                                    description="This is an awesome article for awesome readers"
                                                >
                                                    <span
                                                        aria-hidden="true"
                                                        class="icon icon-facebook"
                                                    ></span
                                                    ><span class="blank"
                                                        >Partager
                                                    </span>
                                                </ShareNetwork>
                                            </li>
                                            <li>
                                                <ShareNetwork
                                                    network="twitter"
                                                    :url="url"
                                                    :title="article.title"
                                                    description="This is an awesome article for awesome readers"
                                                >
                                                    <span
                                                        aria-hidden="true"
                                                        class="icon icon-twitter"
                                                    ></span
                                                    ><span class="blank"
                                                        >Tweeter
                                                    </span>
                                                </ShareNetwork>
                                            </li>
                                            <li>
                                                <ShareNetwork
                                                    network="LinkedIn"
                                                    :url="url"
                                                    :title="article.title"
                                                    description="This is an awesome article for awesome readers"
                                                >
                                                    <span
                                                        aria-hidden="true"
                                                        class="icon icon-linkedin"
                                                    ></span
                                                    ><span class="blank"
                                                        >Partager
                                                    </span>
                                                </ShareNetwork>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <h1>
                                {{ articleTitle }}
                            </h1>
                            <p class="news-date">
                                {{ $t("published-on") }}
                                {{ moment(article.created_at).format("LL") }}
                            </p>
                        </header>
                        <div class="text-zoom" aria-hidden="false">
                            <div class="lead" id="actualite">
                                <div
                                    data-test="typeLienRessourceInterneDTOImage"
                                    class="thumbnail-container"
                                >
                                    <img
                                        :src="getArticleImg(thumbnail)"
                                        alt=""
                                    />
                                </div>

                                <p v-html="articleContent">
                                    <!-- {{ articleContent }} -->
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <div class="modal-sp"></div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import VueHtml2pdf from "vue-html2pdf";
const moment = require("moment");

import imageSrc from "../mixins/imageSrc";
export default {
    mixins: [imageSrc],

    components: {
        VueHtml2pdf,
    },

    computed: {
        ...mapState(["lang"]),
        articleTitle() {
            return this.lang == "fr"
                ? this.article.title
                : this.article.title_ar;
        },
        articleContent() {
            return this.lang == "fr"
                ? this.article.article
                : this.article.article_ar;
        },
        subcategory() {
            return this.lang == "fr"
                ? this.article.sub_name
                : this.article.sub_name_ar;
        },
        category() {
            return this.lang == "fr"
                ? this.article.cat_name
                : this.article.cat_name_ar;
        },
        thumbnail() {
            return this.lang == "fr" && this.article.thumbnail_fr
                ? this.article.thumbnail_fr
                : this.article.thumbnail_ar;
        },
    },
    data() {
        return {
            article: null,
            url: document.URL,
            loading: false,
            moment: moment,
        };
    },
    methods: {
        printPage() {
            console.log(window);
            window.print();
        },

        downloadPDF() {
            this.$refs.DownloadComp.generatePdf();
        },
    },
    created() {
        this.loading = true;
        const id = this.$route.params.id;
        axios
            .get(`/api/article/${id}`)
            .then((result) => {
                if (result.status == 200) {
                    this.article = result.data;
                }
            })
            .catch((err) => {
                console.log(err);
            })
            .then(() => (this.loading = false));
    },
};
</script>

<style scoped>
.thumbnail-container {
    width: 100%;
    height: 500px;
    overflow: hidden;
    margin-bottom: 20px;
}

.thumbnail-container img {
    width: 100%;
    height: 100%;
    object-fit: fill;
}
</style>
