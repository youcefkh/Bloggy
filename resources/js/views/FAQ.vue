<template>
    <div v-if="loading" class="text-center loading">{{$t('loading')}}</div>
    <div class="container main-container" v-else>
        <div class="col-art">
            <article class="article vdd">
                <header id="headerPage">
                    <div class="toolbar toolbar-top"></div>
                    <h1 data-test="titre-page">{{$t('faq-title')}}</h1>
                </header>
                <div></div>
                <div>
                    <div class="content-fiche">
                        <div
                            class="fiche-bloc bloc-principal"
                            data-toggle-scope=""
                        >
                            <div class="fiche-item" v-for="(faq, index) in faqs" :key="'faq'+index">
                                <div class="fiche-item-title">
                                    <h2>
                                        <button
                                            class="btn btn-collapse collapsed"
                                            data-toggle="collapse"
                                            type="button"
                                            :data-target="'#fiche-item-'+index"
                                            data-xiti-name="Particuliers::Vos_droits::Depliant::Achat ou vente d'un logement"
                                            aria-expanded="false"
                                            role="button"
                                            :id="'ui-collapse-'+index"
                                        >
                                            <span v-if="lang=='fr'">
                                                {{faq.question_fr}}
                                            </span>
                                            <span v-else-if="lang=='ar'">
                                                {{faq.question_ar}}
                                            </span>
                                        </button>
                                    </h2>
                                </div>
                                <div
                                    class="fiche-item-content collapse"
                                    :id="'fiche-item-'+index"
                                >
                                    <ul class="list-arrow">
                                        <li data-test="reference">
                                            <div v-if="faq.article_id">
                                                <router-link :to="{name: 'article', params:{lang: lang, id: faq.article_id}}">
                                                    <span v-if="lang=='fr'">{{faq.article.title}}</span>
                                                    <span v-else-if="lang=='ar'">{{faq.article.title_ar}}</span>
                                                </router-link>
                                            </div>
                                            <div v-else>
                                                <p v-if="lang=='fr'">{{faq.response_fr}}</p>
                                                <p v-else-if="lang=='ar'">{{faq.response_ar}}</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <aside role="complementary">
                        <div class="bloc-annexe"></div>
                    </aside>
                </div>
                <!-- .feedback-bloc -->
                <div></div>
                <p class="nav-up">
                    <a href="#top"><span>{{$t('scroll-top')}}</span></a>
                </p>
            </article>
        </div>
        <div class="col-second"><div class="col-second-inner"></div></div>
        <div class="modal-sp"></div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    computed: {
        ...mapState(["lang"]),
    },

    data(){
        return{
            faqs: [],
            loading : false
        }
    },

    async mounted(){
        this.loading = true
        try {
            const response = await axios.get('/api/FAQ');
            if(response.status == 200){
                this.faqs = response.data
            }
        } catch (error) {
            console.log(error)
        }
        this.loading = false
    }
};
</script>

<style scoped>
html:lang(ar) .btn-collapse {
    text-align: right;
}
html:lang(ar) .btn-collapse:after {
    left: 0.3em;
    right: unset;
}
a{
    color: rgb(104, 104, 247);
}
</style>
