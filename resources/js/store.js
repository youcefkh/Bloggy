import axios from 'axios'
import i18n from './i18n'
const moment = require('moment');
export default {
    state: {
        lang: null,
        search: null,
    },
    mutations: {
        setLang(state, payload) {
            state.lang = payload;
        },

        setSearch(state, payload){
            state.search = payload
        }
    },
    actions: {
        setLang(context, {lang, locale}) {
            context.commit("setLang", lang);
            localStorage.setItem("lang", JSON.stringify(lang));
            axios.defaults.headers["Accept-language"] = lang;
            document.documentElement.lang = lang;
            document.querySelector("body").setAttribute("lang", lang);

            if(locale){
                locale.i18n.locale = lang;
            }
            moment.locale(lang);
        },
        loadLang(context, {lang}){
            context.dispatch("setLang", {lang});
        }
    },
};
