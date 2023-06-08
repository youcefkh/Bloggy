<template>
    <div>
        <nav class="breadcrumb" role="navigation" aria-label="Vous êtes ici :">
            <div class="container">
                <p class="breadcrumb-list">
                    <span
                        ><router-link :to="{name: 'home'}"
                            >{{$t('home')}}
                        </router-link
                        ></span
                    ><span class="breadcrumb-separator">&nbsp;&gt;</span
                    ><span
                        ><router-link
                            :to="{name: 'contact'}"
                            data-test="contact-url"
                            >{{$t('contact')}}</router-link
                        ></span
                    >
                    <span class="breadcrumb-separator">&nbsp;&gt;</span
                    ><strong class="active" aria-current="page"
                        >{{$t('suggestion')}}</strong
                    >
                </p>
            </div>
        </nav>
        <div class="container main-container">
            <article class="article">
                <h1 class="title-section">{{$t('suggestion')}}</h1>
                <form @submit.prevent="send" id="contactForm">
                    <input
                        type="hidden"
                        name="_csrf"
                        value="e81c31b1-91f8-4925-bf92-23acbecbd2c6"
                    />

                    <div class="col-mail-compte"></div>
                    <div class="col-mail-compte-narrow">
                        <div
                            class="alert alert-success"
                            id="message"
                            v-if="success"
                        >
                            {{$t('success-message')}}
                        </div>

                        <div
                            class="alert alert-danger"
                            id="message"
                            v-else-if="error"
                        >
                            {{$t('error-message')}}
                        </div>

                        <h2 class="h3">{{$t('your-message')}}</h2>
                        <h3 class="h5">{{$t('send-us-message')}}</h3>
                        <p class="note">
                            {{$t('inputs-marked-with')}}
                            <span class="symbol-required">*</span> {{$t('are-mandatory')}}
                        </p>
                        <div class="form-group">
                            <label for="email"
                                ><span class="symbol-required">*</span> {{$t('your-email')}}
                            </label>
                            <input
                                type="email"
                                data-test="formulaire-contact"
                                class="form-control"
                                id="email"
                                autocomplete="email"
                                aria-required="true"
                                required="required"
                                pattern="^[_A-Za-z0-9-\+-]+(\.[_A-Za-z0-9-\+-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9-\+-]+)*(\.[A-Za-z]{2,})$"
                                oninvalid="setCustomValidity('Veuillez saisir une adresse valide (exemple : nom@exemple.fr)')"
                                oninput="setCustomValidity('')"
                                name="email"
                                v-model="form.email"
                            />
                        </div>
                        <div class="form-group">
                            <label for="subject"
                                ><span class="symbol-required">*</span> {{$t('subject')}}</label
                            ><input
                                type="text"
                                class="form-control"
                                id="subject"
                                required="required"
                                aria-required="true"
                                name="subject"
                                v-model="form.question"
                            />
                        </div>
                        <div class="form-group">
                            <label for="message"
                                ><span class="symbol-required">*</span
                                ><span> {{$t('your-message')}}</span></label
                            >
                            <textarea
                                class="form-control"
                                id="message"
                                required="required"
                                aria-required="true"
                                maxlength="800"
                                cols="30"
                                rows="8"
                                name="message"
                                v-model="form.message"
                            ></textarea>
                            <p
                                class="letter-count"
                                aria-live="polite"
                                aria-atomic="true"
                            >
                                <span class="count">800</span> {{$t('char-left')}}
                            </p>
                        </div>
                        <h3 class="h5">{{$t('code')}}</h3>

                        <div class="form-group">
                            <label for="captchaFormulaireExtInput"
                                ><span class="symbol-required">* </span>
                                {{$t('copy-code')}}</label
                            >
                            <input
                                class="form-control"
                                type="text"
                                id="captchaFormulaireExtInput"
                                required="required"
                                name="captchaCode"
                                aria-required="true"
                                aria-describedby="captcha-hint2"
                                autocomplete="off"
                                style="text-transform: uppercase"
                                v-model="form.code"
                            />
                            <input
                                id="captchaIdInput"
                                type="hidden"
                                name="captchaId"
                            />
                        </div>
                        <h3 class="h5">{{$t('usage-conditions')}}</h3>
                        <div class="opt-in before-submit">
                            <div class="checkbox">
                                <label class="label-in-lines" for="opt-in">
                                    <input
                                        id="opt-in"
                                        type="checkbox"
                                        aria-required="true"
                                        required="required"
                                    /><span class="symbol-required">*</span>
                                    <span class="label-text">
                                        {{$t('accept-information')}}<br />
                                        {{$t('declaration')}}
                                        <a
                                            href="https://www.service-public.fr/P10050"
                                            data-test="cgu-url"
                                            target="_blank"
                                            >{{$t('public-services')}}</a
                                        >
                                        {{$t('website')}}
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="submit">
                            <button
                                class="btn btn-primary"
                                type="submit"
                                id="submitContactForm"
                                data-xiti-name="Particuliers::Footer::Valider::avis"
                                data-xiti-type="action"
                                :disabled="loading"
                            >
                                {{$t('send')}}
                            </button>
                        </div>
                    </div>
                </form>
            </article>
            <div class="modal-sp"></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: null,
                question: null,
                message: null,
                code: null,
            },
            loading: false,
            success: false,
            error: false,
        };
    },

    methods: {
        async send() {
            this.loading = true;
            this.loading = false;
            this.loading = false;
            try {
                const response = await axios.post("/api/contact", this.form);
                if (response.status == 201) {
                    this.form = {
                        email: null,
                        question: null,
                        message: null,
                        code: null,
                    };
                    this.success = true;
                }
            } catch (err) {
                this.error = true;
            }
            this.loading = false;
            this.scrollToMessage();
        },
        scrollToMessage() {
            var element = document.getElementById("message");
            var top = element.offsetTop;

            window.scrollTo({ top: top, behavior: "smooth" });
        },
    },
};
</script>

<style></style>
