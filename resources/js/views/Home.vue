<template>
    <div class="container main-container">
        <div class="home-theme">
            <div class="home-theme-list">
                <div
                    class="home-theme-item"
                    v-for="(cat, index) in categories"
                    :key="'category-' + index"
                >
                    <div class="image-container">
                        <img :src="getCatImg(cat.image)" alt="" />
                    </div>
                    <h3>
                        <a href="#">
                            <span v-if="lang == 'fr'">{{ cat.name }}</span>
                            <span v-else-if="lang == 'ar'">{{
                                cat.name_ar
                            }}</span>
                        </a>
                    </h3>
                    <ul>
                        <li
                            v-for="(sub, index) in cat.subcategories.slice(
                                0,
                                4
                            )"
                            :key="'subcategory-' + index"
                        >
                            <a href="#">
                                <span v-if="lang == 'fr'">{{ sub.name }}</span>
                                <span v-else-if="lang == 'ar'">{{
                                    sub.name_ar
                                }}</span>
                                <span
                                    v-if="
                                        index !==
                                        cat.subcategories.slice(0, 4).length - 1">,</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col_home_1">
            <div class="panel panel-gray">
                <div class="panel-heading">
                    <h2>{{$t('faq-message')}}</h2>
                </div>
                <div class="panel-body">
                    <ul class="list-dotted list-dotted-full list-arrow">
                        <li v-for="(faq) in faqMessage" :key="'faq-message-'+faq.id">
                            <h6>
                                <span v-if="lang=='fr'">{{faq.question_fr}}</span>
                                <span v-else-if="lang=='ar'">{{faq.question_ar}}</span>
                            </h6>
                            <p class="response">
                                <span v-if="lang=='fr'">{{faq.response_fr}}</span>
                                <span v-else-if="lang=='ar'">{{faq.response_ar}}</span>
                            </p>
                        </li>
                    </ul>
                    <p class="link-all">
                        <router-link :to="{name: 'faq'}">{{$t('all-faq')}}</router-link>
                    </p>
                </div>
            </div>
        </div>
        <div class="col_home_2">
            <div class="panel">
                <div class="panel-heading">
                    <h2>{{$t('faq-article')}}</h2>
                </div>
                <div class="panel-body">
                    <ul class="list-dotted list-dotted-full list-arrow">
                        <li v-for="(faq) in faqArticle" :key="'faq-message-'+faq.id">
                            <h6>
                                <span v-if="lang=='fr'">{{faq.question_fr}}</span>
                                <span v-else-if="lang=='ar'">{{faq.question_ar}}</span>
                            </h6>
                            <router-link :to="{name: 'article', params: {'id': faq.article_id}}">
                                <span v-if="lang=='fr'">{{faq.article.title}}</span>
                                <span v-else-if="lang=='ar'">{{faq.article.title_ar}}</span>
                            </router-link>
                        </li>
                    </ul>
                    <p class="link-all">
                        <router-link :to="{name: 'faq'}">{{$t('all-faq')}}</router-link>
                    </p>
                </div>
            </div>
        </div>
        <div class="sp-plus-home">
            <div class="dsfr sp-bandeau-sp-plus-container">
                <div class="sp-container">
                    <div
                        class="sp-bandeau-sp-plus fr-grid-row fr-grid-row--middle fr-mb-4w fr-px-2w fr-pt-3w fr-pb-5v"
                    >
                        <div
                            class="fr-col fr-col-12 fr-col-md-4 fr-pl-2w fr-pl-md-4w fr-pr-md-2w"
                        >
                            <h2 class="fr-ml-n3v fr-ml-md-0 fr-mb-2w">
                                <img
                                    src="assets/img/logo-service-public-plus.svg"
                                    class="fr-responsive-img sp-bandeau-sp-plus-logo"
                                    alt="Services publics plus"
                                />
                            </h2>
                        </div>
                        <div class="fr-col fr-col-12 fr-col-md-8 fr-pl-md-2w">
                            <p class="fr-h5">Publicité</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-actu">
            <h2 class="title-section">{{$t('last-infos')}}</h2>
            <div class="col-home-actu" v-if="!loading_art">
                <div class="home-list-actu">
                    <ul
                        class="home-list-actu-focus"
                        v-for="article in articles"
                        :key="'article-' + article.id"
                    >
                        <li class="news-list-item" data-test="focus-actu">
                            <p class="news-cat">
                                <span v-if="lang == 'fr'">{{
                                    article.cat_name_fr
                                }}</span>
                                <span v-else-if="lang == 'ar'">{{
                                    article.cat_name_ar
                                }}</span>
                            </p>
                            <h3 class="news-title">
                                <router-link
                                    :to="{
                                        name: 'article',
                                        params: { id: article.id },
                                    }"
                                    data-test="titreActu"
                                    ><span v-if="lang == 'fr'">{{
                                        article.title
                                    }}</span>
                                    <span v-else-if="lang == 'ar'">{{
                                        article.title_ar
                                    }}</span>
                                </router-link>
                            </h3>
                            <p class="news-date">
                                <span data-test="dateActu"
                                    >{{ $t("published-on") }}
                                    {{
                                        moment(article.created_at).format("LL")
                                    }}</span
                                >
                            </p>
                            <ul
                                class="news-list-share"
                                data-test="new-share-list"
                            >
                                <li>
                                    <ShareNetwork
                                        network="facebook"
                                        :url="`${url}/${lang}/article/${article.id}`"
                                        :title="article.title"
                                        description="This is an awesome article for awesome readers"
                                    >
                                        <span
                                            aria-hidden="true"
                                            class="icon icon-facebook"
                                        ></span
                                        ><span class="blank">Partager </span>
                                    </ShareNetwork>
                                </li>
                                <li>
                                    <ShareNetwork
                                        network="twitter"
                                        :url="`${url}/${lang}/article/${article.id}`"
                                        :title="article.title"
                                        description="This is an awesome article for awesome readers"
                                    >
                                        <span
                                            aria-hidden="true"
                                            class="icon icon-twitter"
                                        ></span
                                        ><span class="blank">Tweeter </span>
                                    </ShareNetwork>
                                </li>
                                <li>
                                    <ShareNetwork
                                        network="LinkedIn"
                                        :url="`${url}/${lang}/article/${article.id}`"
                                        :title="article.title"
                                        description="This is an awesome article for awesome readers"
                                    >
                                        <span
                                            aria-hidden="true"
                                            class="icon icon-linkedin"
                                        ></span
                                        ><span class="blank">Partager </span>
                                    </ShareNetwork>
                                </li>
                            </ul>
                            <div class="extract">
                                <div
                                    data-test="typeLienRessourceInterneDTOImage"
                                >
                                    <figure class="img" role="group">
                                        <p class="img-src">
                                            <img
                                                v-if="
                                                    lang == 'fr' &&
                                                    article.thumbnail_fr
                                                "
                                                class="lozad img-desc img"
                                                :src="
                                                    getArticleImg(
                                                        article.thumbnail_fr
                                                    )
                                                "
                                                alt="Passe sanitaire valide"
                                                data-test-redimensionnable="true"
                                            />
                                            <img
                                                v-else
                                                class="lozad img-desc img"
                                                :src="
                                                    getArticleImg(
                                                        article.thumbnail_ar
                                                    )
                                                "
                                                alt="Passe sanitaire valide"
                                                data-test-redimensionnable="true"
                                            />
                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-home-follow">
                    <div class="bloc-info-sp bloc-info-twitter">
                        <h2>{{$t('follow-on-twitter')}}</h2>
                        <p>
                            <a
                                class="btn btn-default btn-block btn-twitter"
                                href="https://twitter.com/servicepublicfr"
                                target="_blank"
                                rel="noopener noreferrer"
                                title="service-public.fr sur twitter - twitter.com (nouvelle fenêtre)"
                                data-xiti-name="Social::Twitter::Particuliers::Accueil"
                                data-xiti-type="exit"
                            >
                                <span
                                    aria-hidden="true"
                                    class="icon icon-twitter"
                                ></span>
                                @servicepublicfr
                            </a>
                        </p>
                    </div>
                    <div class="bloc-info-sp bloc-info-facebook">
                        <h2>{{$t('follow-on-fb')}}</h2>
                        <p>
                            <a
                                class="btn btn-primary btn-facebook btn-block"
                                href="https://www.facebook.com/ServicePublicFr"
                                target="_blank"
                                rel="noopener noreferrer"
                                title="service-public.fr sur facebook - facebook.com (nouvelle fenêtre)"
                                data-xiti-name="Social::Facebook::Particuliers::Accueil"
                                data-xiti-type="exit"
                            >
                                <span
                                    aria-hidden="true"
                                    class="icon icon-facebook"
                                ></span>
                                ServicePublicFr
                            </a>
                        </p>
                    </div>
                    <div class="ads ads-aside">
                        <h2 id="titrePub">Publicité</h2>
                        <div
                            id="revive_slot"
                            style="position: relative; top: 0px; left: 0px"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
        <p class="nav-up">
            <a href="#top"><span>{{$t('scroll-top')}}</span></a>
        </p>
        <div class="modal-sp"></div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import imageSrc from "../mixins/imageSrc";
const moment = require("moment");
export default {
    mixins: [imageSrc],

    computed: {
        ...mapState(["lang"]),
    },

    data() {
        return {
            categories: [],
            faqs: [],
            faqMessage: [],
            faqArticle: [],
            articles: [],
            moment: moment,
            url: window.location.hostname,
            loading_art: false,
            loading_cat: false,
            loading_faq: false,
        };
    },
    methods: {
        async getArticles() {
            this.loading_art = true;
            try {
                const response = await axios.get("/api/article");
                if (response.status == 200) {
                    this.articles = response.data;
                }
            } catch (error) {
                console.log(error);
            }
            this.loading_art = false;
        },

        async getCategories() {
            this.loading_cat = true;
            try {
                const response = await axios.get("/api/category");
                if (response.status == 200) {
                    this.categories = response.data;
                }
            } catch (error) {
                console.log(error);
            }
            this.loading_cat = false;
        },

        async getFaqs() {
            this.loading_faq = true;
            try {
                const response = await axios.get("/api/FAQ");
                if (response.status == 200) {
                    this.faqs = response.data;

                    this.faqArticle = this.faqs.filter(
                        (f) => f.article_id !== null
                    ).slice(0,3);

                    this.faqMessage = this.faqs.filter(
                        (f) => f.article_id == null
                    ).slice(0,3);
                }
            } catch (error) {
                console.log(error);
            }
            this.loading_faq = false;
        },
    },
    mounted() {
        this.getArticles();
        this.getCategories();
        this.getFaqs();
    },
};
</script>

<style scooped>
html:lang(ar) .bloc-info-sp h2{
    text-align: right;
}

h3.news-title {
    height: 45px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* number of lines to show */
    -webkit-box-orient: vertical;
}

.img .img-src {
    display: table-caption;
    width: 100%;
    margin-bottom: 0.5em;
    height: 320px;
    position: relative;
}

.img .img-src img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.home-theme-item .image-container {
    overflow: hidden;
    height: 155px;
    width: 100%;
    /* object-fit: cover; */
}

.home-theme-item .image-container img {
    height: 100%;
    object-fit: cover;
    width: 100%;
}

p.response{
    margin: 0;
}
</style>
