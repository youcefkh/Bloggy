<template>
    <header class="banner" role="banner">
        <nav
            class="nav-skip"
            role="navigation"
            aria-label="Liens d&#39;évitement"
            lang="fr"
        >
            <div class="container">
                <ul id="top">
                    <li data-test="skip-link-content">
                        <a href="#main">Aller au contenu</a>
                    </li>
                    <li data-test="skip-link-search">
                        <a href="#search">Aller à la recherche</a>
                    </li>
                    <li data-test="skip-link-navmain" class="skip-link-nav">
                        <a href="#nav-main">Aller au menu de Particuliers</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div
            class="nav-top"
            data-_csrf="d00bd08a-db89-4082-8c70-9c3138d26ce4"
            data-_csrf_header="X-CSRF-TOKEN"
        >
            <div class="container">
                <nav
                    class="nav-top-main"
                    role="navigation"
                    aria-label="menu principal"
                >
                    <ul>
                        <li class="nav-top-menu">
                            <button
                                class="btn btn-menu nav-top-menu"
                                type="button"
                                @click="openNav"
                            >
                                {{$t('menu')}}
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="container container-logo">
            <div class="logo">
                <img
                    data-test="img-non-deuil"
                    class="img-marianne"
                    src="https://www.service-public.fr/resources/v-a0de4bc5fc/web/img/republique-francaise.png"
                    alt="République Française"
                    width="150"
                    height="130"
                />
                <a
                    href="https://www.service-public.fr/"
                    data-xiti-name="Logo::Particuliers::Accueil::Accueil"
                >
                    <img
                        class="img-sce-public"
                        src="https://www.service-public.fr/resources/v-a0de4bc5fc/web/img/service-public.png"
                        alt="Accueil Service-Public.fr"
                        width="250"
                        height="130"
                    />
                </a>
            </div>
            <div class="nav-header">
                <ul>
                    <li class="nav-header-1">
                        <router-link :to="{ name: 'contact' }">
                            <svg
                                focusable="false"
                                width="35"
                                height="35"
                                class="icon-question"
                                aria-hidden="true"
                            >
                                <use xlink:href="#icon-question"></use>
                            </svg>
                            {{ $t("question") }}
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>

        <nav class="mobile">
            <div class="close-wrapper p-2 my-2 d-flex">
                <button
                    class="btn btn-info ml-auto"
                    type="button"
                    title="Fermer le menu Particuliers"
                    @click="closeNav"
                >
                    X {{$t('close')}}
                </button>
            </div>
            <div>
                <div
                    class="accordion accordion-flush"
                    id="accordionFlushExample"
                >
                    <div class="accordion-item" v-for="(cat, index) in categories" :key="'category' + index">
                        <h2 class="accordion-header" :id="'flush-heading'+index">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                :data-bs-target="'#flush-collapse'+index"
                                aria-expanded="false"
                                :aria-controls="'flush-collapse'+index"
                            >
                                <span v-if="lang == 'fr'">{{ cat.name }}</span>
                                <span v-else>{{ cat.name_ar }}</span>
                            </button>
                        </h2>
                        <div
                            :id="'flush-collapse'+index"
                            class="accordion-collapse collapse"
                            :aria-labelledby="'flush-heading'+index"
                            data-bs-parent="#accordionFlushExample"
                        >
                            <div class="accordion-body">
                                <div class="subcategory-wrapper" v-for="sub in cat.subcategories" :key="'subcategory' + sub.id">
                                    <h3 class="subcategory-title">
                                        <span v-if="lang == 'fr'">
                                            {{ sub.name }}
                                        </span>
                                        <span v-else>{{ sub.name_ar }}</span>
                                    </h3>
                                    <ul class="articles-list mx-2">
                                        <li class="mb-2" v-for="article in sub.articles" :key="'article'+article.id">
                                            <router-link
                                                    :to="{ name: 'article', params: {lang: $i18n.locale ,id: article.id } }" 
                                                >
                                                    <span v-if="lang=='fr'">{{article.title}}</span>
                                                    <span v-else>{{article.title_ar}}</span>
                                                </router-link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import { mapState } from "vuex";
export default {
    computed: {
        ...mapState(["lang"]),
    },
    data() {
        return {
            categories: [],
        };
    },

    methods: {
        openNav() {
            const nav = document.querySelector("nav.mobile");
            nav.classList.add("open");
        },

        closeNav() {
            const nav = document.querySelector("nav.mobile");
            nav.classList.remove("open");
        },
    },

    async mounted() {
        try {
            const response = await axios.get(`/api/category`);
            if (response.status == 200) {
                this.categories = response.data;
            }
        } catch (error) {
            console.log(error);
        }
    },
};
</script>

<style scoped>
.container.container-logo {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.container:before,
.container:after {
    content: " ";
    display: none;
}
.nav-header li a {
    width: max-content;
}

nav.mobile {
    color: #fff;
    position: absolute;
    top: -42px;
    left: 0;
    background: #414856;
    height: 100vh;
    z-index: 99999;
    width: 0px;
    transition: all 0.7s ease-in-out;
    overflow: hidden;
}

nav.open {
    width: 70%;
}

html:lang(ar) nav .accordion-button::after{
    margin-left: unset;
    margin-right: auto;
}

html:lang(ar) nav.mobile{
    left: unset;
    right: 0;
}
</style>
