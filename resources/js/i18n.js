import ar from './i18n/ar.json'
import fr from './i18n/fr.json'
import VueI18n from 'vue-i18n'
import Vue from 'vue'

Vue.use(VueI18n)

export default new VueI18n({
    locale: JSON.parse(localStorage.getItem('lang')) ? JSON.parse(localStorage.getItem('lang')) : 'fr',
    messages:{
        ar,
        fr
    }
})