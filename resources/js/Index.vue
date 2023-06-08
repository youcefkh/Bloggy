<template>
    <div id="outer-wrap">
        <div id="inner-wrap">
            <lang-switch-component />
            <header-component />
            <main-nav-component />
            <search-component />
<!--          {!! Adsense::show('responsive') !!}-->
            <main class="main" id="main" role="main">
                <router-view :key="$route.params.id"/>
            </main>
            <footer-component />
        </div>
    </div>
</template>

<script>
import HeaderComponent from "./components/HeaderComponent.vue";
import MainNavComponent from "./components/MainNavComponent.vue";
import SearchComponent from "./components/SearchComponent.vue";
import LangSwitchComponent from "./components/LangSwitchComponent.vue";
import FooterComponent from './components/FooterComponent.vue';

export default {
    components: {
        HeaderComponent,
        SearchComponent,
        MainNavComponent,
        LangSwitchComponent,
        FooterComponent,
    },
    data() {
        return {
            //
        };
    },
    mounted() {
        //console.log(this.$store.state.lang)
    },
};
</script>

<style>
html:lang(ar) * {
    direction: rtl;
    /* text-align: right; */
    /* flex-direction: row-reverse !important; */
}
.loading{
    color: #6666ff;
    margin-top: 40px;
    font-size: 1.2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>
