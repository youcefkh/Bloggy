<template>
    <div class="dsfr">
        <footer class="fr-footer" role="contentinfo" id="footer">
            <div class="fr-container">
                <div class="fr-footer__bottom">
                    <ul class="fr-footer__bottom-list">
                        <li class="fr-footer__bottom-item mx-2" v-for="link in links" :key="'link'+link.id">
                            <a class="fr-footer__bottom-link" :href="link.url">
                                <span v-if="lang=='fr'">{{link.name_fr}}</span>
                                <span v-else-if="lang=='ar'">{{link.name_ar}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
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
            links: null
        }
    },
    async mounted(){
        try {
            const response = await axios.get('/api/footer-links');
            this.links = response.data
        } catch (error) {
            console.log(error)
        }

    }
};
</script>

<style scoped>
.dsfr .fr-footer__bottom-link {
    margin: 0 10px;
}

</style>
