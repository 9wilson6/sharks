<template>
    <ValidationObserver ref="steptwo" tag="form" v-slot="{ invalid }" @submit.prevent="ThirdStep()" class="w-full flex flex-col sm:flex-row sm:flex-wrap text-left">
        <div class="flex flex-col px-1 w-full sm:w-1/2 mb-3">
            <label class="tracking-wide text-gray-700 mb-2" for="title">
                Title
            </label>
            <ValidationProvider name="Title" rules="required" v-slot="{ errors, classes }">
                <input name="title" v-model="title" placeholder="Title" :class="{ 'bg-gray-200 appearance-none border rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white': true, 'border-blue-500': classes.untouched, 'text-gray-700 border-blue-500 focus:border-blue-700': classes.valid, 'text-red-700 border-red-500 focus:border-red-700': classes.invalid }">
                <span class="text-sm text-red-500">{{ errors[0] }}</span>
            </ValidationProvider>
        </div>
        <div class="flex flex-col px-1 w-full sm:w-1/2 mb-3">
            <label class="tracking-wide text-gray-700 mb-2" for="level">
                Level
            </label>
            <div class="relative">
                <select v-model="level" name="level" @change="handleChange" :class="{ 'bg-gray-200 appearance-none border border-blue-500 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-700': true}">
                    <option value="High school">High school</option>
                    <option value="Undergraduate 1-2">Undergraduate 1-2</option>
                    <option value="Undergraduate 3-4">Undergraduate 3-4</option>
                    <option value="Masters">Masters</option>
                    <option value="PHD">PHD</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            <!-- <div v-show="errors.has('level')" class="invalid-feedback">{{ errors.first('level') }}</div> -->
        </div>
        <div class="flex flex-col px-1 w-full sm:w-1/2 mb-3">
            <label class="tracking-wide text-gray-700 mb-2" for="format">
                Format
            </label>
            <div class="relative">
                <select v-model="format" name="format" @change="handleChange" :class="{ 'bg-gray-200 appearance-none border border-blue-500 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-700': true }">
                    <option value="APA">APA</option>
                    <option value="MLA">MLA</option>
                    <option value="CHICAGO">CHICAGO</option>
                    <option value="HARVARD">HARVARD</option>
                    <option value="OTHERS">OTHERS</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            <!-- <div v-show="errors.has('format')" class="invalid-feedback">{{ errors.first('format') }}</div> -->
        </div>
        <div class="flex flex-col px-1 w-full sm:w-1/2 mb-4">
            <label class="tracking-wide text-gray-700 mb-2" for="format">
                Format
            </label>
            <div class="relative">
                <ValidationProvider name="Budget" rules="required" v-slot="{ errors, classes }">
                    <select v-model="budget" name="budget" @change="handleChange" :class="{ 'bg-gray-200 appearance-none border rounded w-full py-2 px-4 leading-tight focus:outline-none focus:bg-white': true , 'border-blue-500': classes.untouched, 'text-gray-700 border-blue-500 focus:border-blue-700': classes.valid, 'text-red-700 border-red-500 focus:border-red-700': classes.invalid }">
                        <option value="">Select budget</option>
                        <option :disabled="estimatePricing.price > 11" value="$5-$10">Mini budget($5-$10)</option>
                        <option :disabled="estimatePricing.price > 32" value="$10-$30">Micro budget($10-$30)</option>
                        <option :disabled="estimatePricing.price > 120" value="$30-$100">Standard budget($30-$100)</option>
                        <option :disabled="estimatePricing.price > 300" value="$100-$250">Medium budget($100-$250)</option>
                        <option :disabled="estimatePricing.price > 600" value="$250-$500">Large budget($250-$500)</option>
                        <option value="$500-$1000">Major budget($500-$1000)</option>
                    </select>
                    <span class="text-sm text-red-500">{{ errors[0] }}</span>
                </ValidationProvider>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            <!-- <div v-show="errors.has('budget')" class="invalid-feedback">{{ errors.first('budget') }}</div> -->
        </div>
        <div class="flex justify-between px-1 w-full mb-2">
            <span  @click.prevent="FirstStep()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded inline-flex justify-center items-center sm:float-right cursor-pointer">
                <svg class="fill-current w-5 h-5 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z" />
                </svg>
                <span class="text-xl ml-2">Back</span>
            </span>
            <button type="submit" :class="{ 'bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded inline-flex justify-center items-center sm:float-right cursor-pointer': true, 'opacity-50 cursor-not-allowed': invalid }">
                <span class="text-xl mr-2">Next</span>                    
                <svg class="fill-current w-5 h-5 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </button>
        </div>
    </ValidationObserver>
</template>
<script>
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
        ESTIMATEPRICING
        
    } from '../../../../store/actions/calculator'
    export default {
        computed: {
            ...mapGetters({
                calculatorvalues: 'GetCalculatorValues',
                isLoggedin: 'isLoggedin',
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
            title: {
                get() {
                    return this.calculatorvalues.title
                },
                set(value) {
                    this.$store.commit(TITLE_REQUEST, value)
                }
            },
            level: {
                get() {
                    return this.calculatorvalues.level
                },
                set(value) {
                    this.$store.commit(LEVEL_REQUEST, value)
                    this.$store.dispatch(ESTIMATEPRICING)
                }
            },
            format: {
                get() {
                    return this.calculatorvalues.format
                },
                set(value) {
                    this.$store.commit(FORMAT_REQUEST, value)
                }
            },
            budget: {
                get() {
                    return this.calculatorvalues.budget
                },
                set(value) {
                    this.$store.commit(BUDGET_REQUEST, value)
                }
            }
        },
        mounted() {
            this.$store.commit(SETSPINNER_REQUEST, false)
        },
        methods: {
            handleChange(value) {
                this.$store.dispatch(ESTIMATEPRICING)
            },
            FirstStep(){
                this.$store.commit(SETSPINNER_REQUEST, true)
                this.$store.commit(SET_STEP, 'one')
            },
            async ThirdStep() {
                const isValid = await this.$refs.steptwo.validate()
                if (isValid) {
                    this.$store.commit(SETSPINNER_REQUEST, true)
                    this.$store.commit(SET_STEP, 'three')
                }
            }
        }

    }
</script>