<template>
    <nav
        class="nav-main"
        id="nav-main"
        role="navigation"
        aria-label="menu Particuliers"
    >
        <div class="container">
            <ul class="nav-main-first nav-main-desktop" id="nav-main-dropdown">
                <li class="active" data-test="Accueil_active">
                    <router-link
                        class="nav-main-item nav-main-home"
                        :to="{name: 'home'}"
                        title="Accueil - actif"
                    >
                        <span class="icon icon-home" aria-hidden="true"></span
                        ><span class="blank">Accueil - actif</span>
                    </router-link>
                </li>
                <li
                    class="panel"
                    v-for="cat in categories"
                    :key="'category' + cat.id"
                >
                    <a
                        class="nav-main-item"
                        href="#"
                        data-parent="#nav-main-dropdown"
                        data-toggle="collapse"
                        :data-target="'#nav-main-cat'+cat.id"
                        data-xiti-type="navigation"
                    >
                        <span v-if="lang == 'fr'">{{ cat.name }}</span>
                        <span v-else>{{ cat.name_ar }}</span>
                    </a>
                    <div
                        class="nav-main-dropdown-inner collapse"
                        :id="'nav-main-cat'+cat.id"
                    >
                        <div class="container">
                            <!-- <p class="close">
                                <button
                                    class="btn-close"
                                    type="button"
                                    :data-target="'#nav-main-cat'+cat.id"
                                >
                                    Fermer
                                </button>
                            </p> -->
                            <div class="nav-main-sous-theme" role="list">
                                <div class="col-nav-main" role="presentation">
                                    <div
                                        role="listitem"
                                        v-for="sub in cat.subcategories"
                                        :key="'subcategory' + sub.id"
                                    >
                                        <p v-if="lang == 'fr'">
                                            {{ sub.name }}
                                        </p>
                                        <p v-else>{{ sub.name_ar }}</p>

                                        <ul>
                                            <li v-for="article in sub.articles" :key="'article'+article.id">
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
                </li>
            </ul>
        </div>
    </nav>
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
.nav-main-sous-theme {
    display: flex;
}

.nav-main .nav-main-first {
    display: flex;
    justify-content: stretch;
    align-items: center;
}
.nav-main-dropdown-inner ul {
    margin: 0 10px;
}
.nav-main .nav-main-first>li {
    flex-grow: 1;
}
</style>
