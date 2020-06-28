<template>
    <div>
        <div v-show="autherror" class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">Error</p>
            <p><strong>{{ autherror }}</strong></p>
        </div>
        <ValidationObserver ref="register" tag="form" v-slot="{ invalid }" @submit.prevent="RegisterNow()">
            <a-spin :spinning="spinning" tip="Registering you..." size="large">
                <div class="flex flex-col text-left p-0">
                    <div class="flex flex-col w-full mb-3 mt-2">
                        <label class="tracking-wide text-gray-700 font-medium mb-1" for="username">
                            Username:
                        </label>
                        <ValidationProvider name="Username" rules="required|alpha_num" v-slot="{ errors, classes }">
                            <input id="username" name="username" required autocomplete="username" autofocus placeholder="Choose a username" type="text" v-model="username" :class="{ 'bg-gray-200 appearance-none border rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white': true, 'border-blue-500': classes.untouched, 'text-gray-700 border-blue-500 focus:border-blue-700': classes.valid, 'text-red-700 border-red-500 focus:border-red-700': classes.invalid }">
                            <span class="text-sm text-red-500">{{ errors[0] }}</span>
                        </ValidationProvider>
                    </div>
                    <div class="flex flex-col w-full mb-3">
                        <label class="tracking-wide text-gray-700 font-medium mb-1" for="fullname">
                            Full name:
                        </label>
                        <ValidationProvider name="Full name" rules="required|alpha_spaces" v-slot="{ errors, classes }">
                            <input id="fullname" name="fullname" required autocomplete="name" autofocus placeholder="Full name" type="text" v-model="fullname" :class="{ 'bg-gray-200 appearance-none border rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white': true, 'border-blue-500': classes.untouched, 'text-gray-700 border-blue-500 focus:border-blue-700': classes.valid, 'text-red-700 border-red-500 focus:border-red-700': classes.invalid }">
                            <span class="text-sm text-red-500">{{ errors[0] }}</span>
                        </ValidationProvider>
                    </div>
                    <div class="flex flex-col w-full mb-3">
                        <label class="tracking-wide text-gray-700 font-medium mb-1" for="password">
                            Password:
                        </label>
                        <ValidationProvider name="Password" rules="required" v-slot="{ errors, classes }">
                            <input id="password" name="password" placeholder="Password" required autocomplete="new-password" type="password" v-model="password" :class="{ 'bg-gray-200 appearance-none border rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white': true, 'border-blue-500': classes.untouched, 'text-gray-700 border-blue-500 focus:border-blue-700': classes.valid, 'text-red-700 border-red-500 focus:border-red-700': classes.invalid }">
                        </ValidationProvider>
                    </div>
                    <div class="flex flex-col w-full mb-3">
                        <label class="tracking-wide text-gray-700 font-medium mb-1" for="password_confirmation">
                            Confirm Password:
                        </label>
                        <ValidationProvider name="Password" rules="required" v-slot="{ errors, classes }">
                            <input id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password" type="password" v-model="password_confirmation" :class="{ 'bg-gray-200 appearance-none border rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white': true, 'border-blue-500': classes.untouched, 'text-gray-700 border-blue-500 focus:border-blue-700': classes.valid, 'text-red-700 border-red-500 focus:border-red-700': classes.invalid }">
                        </ValidationProvider>
                    </div>
                    <div class="flex flex-col w-full">
                        <button type="submit" :class="{ 'bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded inline-flex justify-center items-center sm:float-right cursor-pointer': true, 'opacity-50 cursor-not-allowed': invalid }">
                            <span class="text-2xl mr-2">Post Homework</span>                    
                            <svg class="fill-current w-5 h-5 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
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
        REGITERUSERNAME_REQUEST,
        REGISTERFULLNAME_REQUEST,
        REGISTERPASSWORD_REQUEST,
        REGISTERCONFIRMPASSWORD_REQUEST,
        POSTHOMEWORK_REGISTER_REQUEST
    } from '../../../../store/actions/calculator'
    export default {
        computed: {
            ...mapGetters({
                registerdetails: 'GetRegisterDetails',
                spinning: 'GetRegisterSpinning',
                autherror: 'GetAuthError'
            }),
            username: {
                get() {
                    return this.registerdetails.username
                },
                set(value) {
                    this.$store.commit(REGITERUSERNAME_REQUEST, value)
                }
            },
            fullname: {
                get() {
                    return this.registerdetails.fullname
                },
                set(value) {
                    this.$store.commit(REGISTERFULLNAME_REQUEST, value)
                }
            },
            password: {
                get() {
                    return this.registerdetails.password
                },
                set(value) {
                    this.$store.commit(REGISTERPASSWORD_REQUEST, value)
                }
            },
            password_confirmation: {
                get() {
                    return this.registerdetails.password_confirmation
                },
                set(value) {
                    this.$store.commit(REGISTERCONFIRMPASSWORD_REQUEST, value)
                }
            }
        },
        methods: {
            async RegisterNow() {
                const isValid = await this.$refs.register.validate()
                if (isValid) {
                    this.$store.dispatch(POSTHOMEWORK_REGISTER_REQUEST, this.registerdetails)
                }
            }
        },
    }
</script>