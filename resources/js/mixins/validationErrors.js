export default{
    data(){
        return{
            errors: null,
        }
    },

    methods: {
        errorFor(field){
            return this.errors && this.errors[field] && this.errors[field][0] !== null ? this.errors[field][0] : null;
        }
    },
} 