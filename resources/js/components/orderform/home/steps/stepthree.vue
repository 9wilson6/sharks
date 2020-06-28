<template>
    <ValidationObserver ref="stepfinal" tag="form" v-slot="{ invalid }" @submit.prevent="FinalStep()" class="w-full flex flex-col text-left">
        <div class="mb-3">
            <div class="flex flex-col px-3">
                <label class="tracking-wide text-gray-700 mb-2" for="orderdetails">
                    Order details:
                </label>
                <ValidationProvider name="Order details" rules="required" v-slot="{ errors, classes }">
                    <text-editor  name="orderdetails" v-model="orderdetails" api-key="q1ba0baz01vm4f2mhc4194dfd9b2sfalus1cgl5qsqa11281" :init="{plugins: 'wordcount'}" :class="{'form-control': true, 'is-invalid': false}"></text-editor>
                    <small class="form-text text-danger">{{ errors[0] }}</small>
                </ValidationProvider>
            </div>
        </div>
        <div class="mb-3">
            <label class="flex items-center px-3">
                <input :checked="termsandconditions" id="termsandconditions" name="termsandconditions" v-model="termsandconditions" @change="onChange" :class="{'mr-2 leading-tight': true, 'is-invalid': true}" type="checkbox">
                <label class="text-sm" for="termsandconditions"> I have read and agree to <a href="#">Terms and Condition</a></label>
            </label>
        </div>
        <div class="flex justify-between px-1 w-full mb-2">
            <span @click.prevent="SecondStep()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded inline-flex justify-center items-center sm:float-right cursor-pointer">
                <svg class="fill-current w-5 h-5 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z" />
                </svg>
                <span class="text-xl ml-2">Back</span>
            </span>
            <button type="submit" :class="{ 'bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded inline-flex justify-center items-center sm:float-right cursor-pointer': true, 'opacity-50 cursor-not-allowed': invalid }">
                <span class="text-xl mr-2">Proceed</span>                    
                <svg class="fill-current w-5 h-5 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </button>
        </div>
        <a-modal
            title="Sign in below to submit homework"
            :visible="showlogin"
            :maskClosable="false"
            :footer="null"
            :width="340"
            @cancel="cancelLoginModal">
            <sign-in></sign-in>
        </a-modal>

        <a-modal
            title="Register below to submit homework"
            :visible="showregister"
            :maskClosable="false"
            :footer="null"
            :width="340"
            @cancel="cancelRegisterModal">
            <register-now></register-now>
        </a-modal>
    </ValidationObserver>
</template>
<script>
    import tinymce from 'tinymce';
    // A theme is also required
    import { extend } from 'vee-validate'
    import 'tinymce/themes/modern/theme';
    import 'tinymce/plugins/wordcount';
    import { mapGetters } from 'vuex'
    import SignIn from "./signin.vue";
    import RegisterNow from "./register.vue";
    import {
        TITLE_REQUEST,
        FORMAT_REQUEST,
        LEVEL_REQUEST,
        BUDGET_REQUEST,
        SETSPINNER_REQUEST,
        SET_STEP,
        ESTIMATEPRICING,
        ORDERDETAILS_REQUEST,
        SHOWLOGIN_REQUEST,
        SHOWREGISTER_REQUEST,
        POSTHOMEWORK_REQUEST
    } from '../../../../store/actions/calculator'
    import Editor from '@tinymce/tinymce-vue';

    export default {
        data() {
            return {
                confirmLoading: false,
                termsandconditions: true
            }
        },
        components: {
            'text-editor': Editor,
            'sign-in': SignIn,
            'register-now': RegisterNow
        },
        mounted() {
            this.$store.commit(SETSPINNER_REQUEST, false)
        },
        computed: {
            ...mapGetters({
                calculatorvalues: 'GetCalculatorValues',
                showlogin: 'showLogin',
                showregister: 'showRegister'
            }),
            orderdetails: {
                get() {
                    return this.calculatorvalues.orderdetails
                },
                set(value) {
                    this.$store.commit(ORDERDETAILS_REQUEST, value)
                }
            }
        },
        methods: {
            handleChange(value) {},
            SecondStep(){
                this.$store.commit(SET_STEP, 'two')
            },
            async FinalStep() {
                const isValid = await this.$refs.stepfinal.validate()
                if (isValid) {
                    this.$store.commit(SETSPINNER_REQUEST, true)
                    this.$store.dispatch(POSTHOMEWORK_REQUEST, this.calculatorvalues)
                }
            },
            onChange (e) {
                this.termsandconditions = e.target.checked
            },
            cancelLoginModal(e) {
                this.$store.commit(SHOWLOGIN_REQUEST, false)
            },
            cancelRegisterModal(e) {
                this.$store.commit(SHOWREGISTER_REQUEST, false)
            }
        }

    }
</script>