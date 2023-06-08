import VueRouter from 'vue-router'
import i18n from './i18n'
import store from './store'
//components
import Home from './views/Home.vue'
import Article from './views/Article.vue'
import Contact from './views/Contact.vue'
import FAQ from './views/FAQ.vue'
import Result from './views/Result.vue'

const routes = [
    {
        path: "/",
        redirect: `/${i18n.locale}`
    },
    {
        path: '/:lang',
        component:{
            render(c) {
                return c('router-view')
            },
        },
        children:[
            {
                path: "/",
                name: "home",
                component: Home
            },
            {
                path: "article/:id",
                name: "article",
                component: Article
            },
            {
                path: "contact",
                name: "contact",
                component: Contact
            },
            {
                path: "faq",
                name: "faq",
                component: FAQ
            },
            {
                path: "result",
                name: "result",
                component: Result
            },
        ]
    
    }
]

const router = new VueRouter({
    routes,
    mode: "history"
});

router.beforeEach((to, from, next) => {

    // use the language from the routing param or default language
    let language = to.params.lang;
    if (!language) {
      language = localStorage.getItem('lang') ? JSON.parse(localStorage.getItem('lang') ) : "fr";
    }
    // set the current language for vuex-i18n. note that translation data
    // for the language might need to be loaded first
    i18n.locale = language;
    next();
  
});

export default router;