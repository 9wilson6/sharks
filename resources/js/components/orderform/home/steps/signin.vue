<template>
    <div>
        <div v-show="autherror" class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">Error</p>
            <p><strong>{{ autherror }}</strong></p>
        </div>
        <ValidationObserver ref="signin" tag="form" v-slot="{ invalid }" @submit.prevent="SignIn()">
            <a-spin :spinning="spinning" tip="Registering you..." size="large">
                <div class="flex flex-col text-left p-0">
                    <div class="flex flex-col w-full mb-3 mt-2">
                        <label class="tracking-wide text-gray-700 font-medium mb-1" for="emailaddress">
                            Email address:
                        </label>
                        <input name="emailaddress" placeholder="Email address" disabled="disabled" autofocus required autocomplete="email" type="email" v-model="emailaddress" :class="{ 'bg-gray-200 appearance-none border text-gray-700 border-blue-500 focus:border-blue-700 rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white opacity-50 cursor-not-allowed': true }">
                    </div>
                    <div class="flex flex-col w-full mb-3">
                        <label class="tracking-wide text-gray-700 font-medium mb-1" for="password">
                            Password:
                        </label>
                        <ValidationProvider name="Password" rules="required" v-slot="{ errors, classes }">
                            <input id="password" name="password" placeholder="Password" required autocomplete="current-password" type="password" v-model="password" :class="{ 'bg-gray-200 appearance-none border rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white': true, 'border-blue-500': classes.untouched, 'text-gray-700 border-blue-500 focus:border-blue-700': classes.valid, 'text-red-700 border-red-500 focus:border-red-700': classes.invalid }">
                        </ValidationProvider>
                    </div>

                    <div class="w-full flex justify-between items-center">
                        <a href="/password/reset" target="_blank" class="text-sm font-medium text-blue-500">
                            Forgot Password
                        </a>
                        <button type="submit" :class="{ 'bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded inline-flex justify-center items-center sm:float-right cursor-pointer': true, 'opacity-50 cursor-not-allowed': invalid }">
                            <span class="text-sm">Post Homework</span>                    
                            <svg class="fill-current w-2 h-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </a-spin>
        </ValidationObserver>
    </div>
</template>

<script>
    import {
        mapGetters
    } from 'vuex'
    import {
        LOGINEMAILADDRESS_REQUEST,
        LOGINPASSWORD_REQUEST,
        POSTHOMEWORK_LOGIN_REQUEST
    } from '../../../../store/actions/calculator'
    export default {
        computed: {
            ...mapGetters({
                logindetails: 'GetLoginDetails',
                calculatorvalues: 'GetCalculatorValues',
                spinning: 'GetLoginSpinning',
                autherror: 'GetAuthError'
            }),
            emailaddress: {
                get() {
                    return this.calculatorvalues.emailaddress
                }
            },
            password: {
                get() {
                    return this.logindetails.password
                },
                set(value) {
                    this.$store.commit(LOGINPASSWORD_REQUEST, value)
                }
            }
        },
        methods: {
            onChange(e) {},
            async SignIn() {
                const isValid = await this.$refs.signin.validate()
                if (isValid) {
                    this.$store.dispatch(POSTHOMEWORK_LOGIN_REQUEST, this.logindetails)
                }
            }
        },
    }
</script>