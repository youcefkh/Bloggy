<template>
    <div class="switch-container">
        <div class="switch">
            <input
                id="language-toggle"
                class="check-toggle check-toggle-round-flat"
                type="checkbox"
                @change="switchLang"
                v-model="currentValue"
            />
            <label for="language-toggle"></label>
            <span class="on">FR</span>
            <span class="off">AR</span>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    computed: {
        ...mapState(["lang"]),
        language() {
            return this.currentValue ? "ar" : "fr";
        },
    },
    data() {
        return {
            currentValue: null,
        };
    },
    methods: {
        switchLang(e) {
            this.$store.dispatch("setLang", {
                lang: this.language,
                locale: { i18n: this.$i18n },
            });
            /* change route lang param */
            let params = this.$route.params;
            params['lang'] = this.language;
            this.$router.push({ name: this.$route.name, params: params });
        },
    },
    mounted() {
        this.currentValue = this.lang == "fr" ? false : true;
    },
};
</script>

<style scoped>
.switch-container {
    background: #e7e3e3;
    width: 100%;
    height: 42px;
    position: relative;
}
.switch {
    position: absolute;
    top: 2px;
    right: 10px;
    display: inline-block;
    margin: 0 5px;
    z-index: 9999;
}

.switch > span {
    position: absolute;
    top: 10px;
    pointer-events: none;
    font-family: "Helvetica", Arial, sans-serif;
    font-weight: bold;
    font-size: 12px;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(0, 0, 0, 0.06);
    width: 50%;
    text-align: center;
}

input.check-toggle-round-flat:checked ~ .off {
    color: #6666ff;
}

input.check-toggle-round-flat:checked ~ .on {
    color: #fff;
}

.switch > span.on {
    left: 0;
    padding-left: 2px;
    color: #6666ff;
}

.switch > span.off {
    right: 0;
    padding-right: 4px;
    color: #fff;
}

.check-toggle {
    position: absolute;
    margin-left: -9999px;
    visibility: hidden;
}
.check-toggle + label {
    display: block;
    position: relative;
    cursor: pointer;
    outline: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

input.check-toggle-round-flat + label {
    padding: 2px;
    width: 97px;
    height: 35px;
    background-color: #6666ff;
    -webkit-border-radius: 60px;
    -moz-border-radius: 60px;
    -ms-border-radius: 60px;
    -o-border-radius: 60px;
    border-radius: 60px;
}
input.check-toggle-round-flat + label:before,
input.check-toggle-round-flat + label:after {
    display: block;
    position: absolute;
    content: "";
}

input.check-toggle-round-flat + label:before {
    top: 2px;
    left: 2px;
    bottom: 2px;
    right: 2px;
    background-color: #6666ff;
    border-radius: 60px;
}
input.check-toggle-round-flat + label:after {
    top: 4px;
    left: 4px;
    bottom: 4px;
    width: 48px;
    background-color: #fff;
    -webkit-border-radius: 52px;
    -moz-border-radius: 52px;
    -ms-border-radius: 52px;
    -o-border-radius: 52px;
    border-radius: 52px;
    -webkit-transition: margin 0.2s;
    -moz-transition: margin 0.2s;
    -o-transition: margin 0.2s;
    transition: margin 0.2s;
}

/* input.check-toggle-round-flat:checked + label {
    
} */

input.check-toggle-round-flat:checked + label:after {
    margin-left: 44px;
}
</style>
