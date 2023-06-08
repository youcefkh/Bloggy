require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router';
import router from './routes';
import Vuex from 'vuex'
import storeDefinition from './store'
import i18n from './i18n'
import VueSocialSharing from 'vue-social-sharing'



import Index from './Index.vue'

window.Vue = require('vue').default;



Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueSocialSharing);

const store = new Vuex.Store(storeDefinition)

const app = new Vue({
    i18n,
    el: '#app',
    store,
    router,
    components: {
        "Index": Index
    },
    beforeCreate(){
        this.$store.dispatch("loadLang", {lang: this.$route.params.lang});
    }
});
