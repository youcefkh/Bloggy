<template>
    <div v-if="loading" class="text-center loading">{{$t('loading')}}</div>
    <div v-else>
        <div class="container main-container">
            <div id="results" class="col-main">
                <h1 class="result-title">
                    <span id="nbResult">{{nbrResult}}</span>
                    {{$t('result-for')}}&nbsp;:
                    <span id="searchTerm"
                        >«&nbsp;<mark>{{search}}</mark>&nbsp;»</span
                    >
                </h1>
                <div class="content-result-section">
                    <div class="result-section" v-for="sub in articles" :key="'sub-'+sub.name">
                        <h2
                            id="nbResult_fichePratique"
                            class="result-section-heading"
                        >
                            <span v-if="lang=='fr'">{{sub.name}}</span>
                            <span v-else-if="lang=='ar'">{{sub.name}}</span> 
                            ({{sub.articles_count}})
                        </h2>
                        <ul id="results_fichePratique" class="result-list">
                            <li class="result-item" v-for="article in sub.articles" :key="'article-'+article.id">
                                <router-link
                                    :to="{name: 'article', params: {id: article.id}}"
                                    data-xiti-name="Particuliers::Accueil::passport::Sport_de_compétition"
                                    data-xiti-type="navigation"
                                >
                                    <span class="result-name">
                                        <span v-if="lang=='fr'">{{article.title}}</span>
                                        <span v-else-if="lang=='ar'">{{article.title_ar}}</span> 
                                    </span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    computed: {
        ...mapState(["lang"]),

        nbrResult(){
            return this.articles ? this.articles.reduce((initial, current) => initial + current.articles_count, 0) : 0;
        }
    },
    data() {
        return {
            search: this.$route.query.search,
            articles: [],
            loading: false,
        };
    },
    watch: {
        "$route.query.search"() {
            this.search = this.$route.query.search;
            if(this.search){
                this.getData();
            }
        },
    },

    methods: {
        async getData(){
            this.loading = true;
            try {
                const response = await axios.post('/api/search', {search: this.search})
                if(response.status){
                    const result = response.data
                    this.articles = result.filter(a => a.articles_count > 0)
                }
            } catch (error) {
                console.log(error)
            }
            this.loading = false;
        },
        
    },

    mounted(){
        if(this.search){
            this.getData()
        }
    }
};
</script>

<style></style>
