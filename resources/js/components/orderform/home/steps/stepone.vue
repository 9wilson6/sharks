<template>
    <ValidationObserver ref="stepone" tag="form" v-slot="{ invalid }" @submit.prevent="SecondStep()" class="w-full flex flex-col sm:flex-row sm:flex-wrap text-left">
        <div class="flex flex-col px-1 w-full sm:w-1/2 mb-3">
            <label class="tracking-wide text-gray-700 mb-2" for="emailaddress">
                Email Address
            </label>
            <ValidationProvider name="Email address" rules="email|required" v-slot="{ errors, classes }">
                <input :disabled="loggedin"  name="emailaddress" v-model="emailaddress" placeholder="Email address" :class="{ 'bg-gray-200 appearance-none border rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white': true, 'border-blue-500': classes.untouched, 'text-gray-700 border-blue-500 focus:border-blue-700': classes.valid, 'text-red-700 border-red-500 focus:border-red-700': classes.invalid }">
                <span class="text-sm text-red-500">{{ errors[0] }}</span>
            </ValidationProvider>
        </div>
        <div class="flex flex-col px-1 w-full sm:w-1/2 mb-3">
            <label class="tracking-wide text-gray-700 mb-2" for="emailaddress">
                Deadline
            </label>
            <ValidationProvider name="Deadline" rules="required|datetime" v-slot="{ errors, classes }">
                <datetime
                    type="datetime"
                    v-model="deadline"
                    name="deadline"
                    placeholder="Select Deadline"
                    :input-class="{'bg-gray-200 appearance-none border rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white': true, 'border-blue-500': classes.untouched, 'text-gray-700 border-blue-500 focus:border-blue-700': classes.valid, 'text-red-700 border-red-500 focus:border-red-700': classes.invalid }"
                    :format="{ year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit' }"
                    :phrases="{ok: 'Select Deadline', cancel: 'Exit'}"
                    :hour-step="2"
                    :minute-step="15"
                    :week-start="7"
                    use12-hour
                    auto></datetime>
                    <span class="text-sm text-red-500">{{ errors[0] }}</span>
                    <small v-show="!true && deadline && datefromnowpast" class="form-text text-muted">Your task will be completed in {{ deadline | datefromnow }}</small>
            </ValidationProvider>
        </div>
        <div class="flex flex-col px-1 w-full sm:w-1/2 mb-3">
            <label class="tracking-wide text-gray-700 mb-2" for="subject">
                Subject
            </label>
            <ValidationProvider name="Subject" rules="required" v-slot="{ errors }">
                <div class="relative">
                    <select v-model="subject" name="subject" @change="handleChange" :class="{ 'bg-gray-200 appearance-none border border-blue-500 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-700': true, 'is-invalid': false }">
                        <option selected value="Art">Art</option>
                        <option value="Business">Business</option>
                        <option value="English">English</option>
                        <option value="Computer">Computer</option>
                        <option value="Foregn Language">Foregn Language</option>
                        <option value="History">History</option>
                        <option value="Law">Law</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Medicine">Medicine</option>
                        <option value="Philosophy">Philosophy</option>
                        <option value="Science">Science</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                <span class="text-sm text-red-500">{{ errors[0] }}</span>
            </ValidationProvider>           
        </div>
        <div class="flex flex-col px-1 w-full sm:w-1/2 mb-6">
            <label class="tracking-wide text-gray-700 mb-2" for="pages">
                Pages: <span style="color:blue; font-weight: bold;">Words: <span v-html="numpages * 275"></span></span>
            </label>
            <div class="flex w-full">
                <div class="flex w-3/4 bg-gray-200 border border-blue-500 rounded">
                    <span @click.prevent="changePages('minus')" class="cursor-pointer w-1/4">
                        <svg viewBox="0 0 24 24" class="text-gray-700 h-5 w-6 my-2 mx-auto" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </span>
                    <input name="numpages" disabled="disabled" v-model="numpages" class="w-2/4 shadow-inner bg-gray-200 appearance-none py-2 px-4 leading-tight text-center text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="numberogpages" type="text">                          
                    <span @click.prevent="changePages('plus')" class="cursor-pointer w-1/4">
                        <svg viewBox="0 0 24 24" class="text-gray-700 h-5 w-6 my-2 mx-auto" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </span>
                </div>
                <div class="w-1/4 flex-grow">
                    <div class="mt-2 mr-0 float-right cursor-pointer">
                        <img src="/img/xtooltip_main.png" alt="">
                    </div>
                </div>
            </div>
        </div>            
        <div class="flex flex-col px-1 w-full mb-5">
            <button type="submit" :class="{ 'bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded inline-flex justify-center items-center sm:float-right cursor-pointer': true, 'opacity-50 cursor-not-allowed': invalid }">
                <span class="text-2xl mr-2">Next</span>                    
                <svg class="fill-current w-5 h-5 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </button>
        </div>
    </ValidationObserver>
</template>
<script>
    import Vue from 'vue'
    import moment from 'moment'
    import Datetime from 'vue-datetime'
    // You need a specific loader for CSS files
    import { extend } from 'vee-validate'
    import 'vue-datetime/dist/vue-datetime.css'
    import { mapGetters } from 'vuex'
    import {
        EMAILADDRESS_REQUEST,
        DEADLINE_REQUEST,
        SUBJECT_REQUEST,
        SETSPINNER_REQUEST,
        NUMPAGES_REQUEST,
        SET_STEP,
        ESTIMATEPRICING,
        BUDGET_REQUEST
    } from '../../../../store/actions/calculator'
    Vue.use(Datetime)   
   
    export default {
        created() {
            extend('datetime', {
                validate: value => {
                    let twentyfour = moment().add(23, 'h')
                    return moment(value).isAfter(twentyfour)
                },
                message: 'Minimun deadline is 24 hours'
            })
        },
        filters: {
            datefromnow(userDeadline) {
                return moment(new Date(userDeadline)).fromNow();
            }
        },
        computed: {
            ...mapGetters({
                calculatorvalues: 'GetCalculatorValues',
                loggedin: 'isLoggedin',
                ePricing: 'getestimatePricing'
            }),
            estimatePricing(){
                let pricing = {
                    pp: this.ePricing,
                    price: _.round(this.ePricing, 0),
                    others: _.round(this.ePricing * 4.87, 0)
                }
                return pricing
            },
            emailaddress: {
                get() {
                    return this.calculatorvalues.emailaddress
                },
                set(value) {
                    this.$store.commit(EMAILADDRESS_REQUEST, value)
                }
            },
            deadline: {
                get() {
                    return this.calculatorvalues.deadline
                },
                set(value) {
                    this.$store.commit(DEADLINE_REQUEST, value)
                    this.$store.commit(BUDGET_REQUEST, '')
                }
            },
            subject: {
                get() {
                    return this.calculatorvalues.subject
                },
                set(value) {
                    this.$store.commit(SUBJECT_REQUEST, value)
                }
            },
            numpages: {
                get() {
                    return this.calculatorvalues.numpages
                    this.$store.commit(BUDGET_REQUEST, '')
                }
            },
            datefromnowpast() {
                let twentyfour = moment().add(23, 'h')
                if (this.calculatorvalues.deadline) {
                    return moment(this.calculatorvalues.deadline).isAfter(twentyfour)
                }
                return false
            }
        },
        watch: {
            deadline: function (val) {
                this.handleChange(1)
            }
        },
        mounted() {
            this.$store.commit(SETSPINNER_REQUEST, false)
        },
        methods: {
            handleChange(value) {
                this.$store.dispatch(ESTIMATEPRICING)
            },
            changePages(value) {
                this.$store.commit(NUMPAGES_REQUEST, value)
                this.handleChange(1)
            },
            async SecondStep() {
                const isValid = await this.$refs.stepone.validate()
                if (isValid) {
                    this.$store.commit(SETSPINNER_REQUEST, true)
                    this.$store.commit(SET_STEP, 'two')
                }
            }
        }
    }
</script>