<template>
    <div class="search" role="search" id="search">
        <form
            id="recherche"
            method="get"
            action="search.html"
            class="search-site"
            @submit.prevent="send"
        >
            <div class="container">
                <h1 class="sr-only">
                    <span>Service-Public.fr Particuliers : </span>Connaître vos
                    droits, <br />
                    effectuer vos démarches
                </h1>
                <div class="input-group">
                    <input
                        type="search"
                        class="form-control"
                        id="keyword"
                        title="Recherche dans l&#39;espace Particuliers (Exemple : Passeport, mairie de Montreuil, acte de naissance…)"
                        autocomplete="off"
                        name="keyword"
                        :placeholder="$t('search-bar-placeholder')"
                        maxlength="300"
                        data-test="search-input"
                        aria-label="Recherche dans l&#39;espace Particuliers (Exemple : Passeport, mairie de Montreuil, acte de naissance…)"
                        v-model="search"
                    />
                    <span class="input-group-btn">
                        <button
                            class="btn"
                            type="submit"
                            title="Rechercher dans service-public.fr"
                            data-xiti-name="recherche::Particuliers::Accueil::Accueil"
                            data-xiti-type="action"
                        >
                            <span
                                aria-hidden="true"
                                class="icon icon-search"
                            ></span
                            ><span class="blank" data-test="search-button"
                                >Rechercher dans service-public.fr</span
                            >
                        </button>
                    </span>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            search: null
        }
    },

    methods: {
        send(){
            if(this.search){
                this.$router.push({name: 'result', query: { 'search' : this.search}})
            }
        }
    }
};
</script>

<style scoped>
form#recherche .container .input-group {
    width: 80%;
}
</style>
