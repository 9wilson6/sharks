<template>
     <form @submit.prevent="ThirdStep()" novalidate>
     <div class="row">
        <div class="form-group col-md-6">
            <label for="title">Title:</label>
            <input data-vv-validate-on="none" v-validate="'required'" data-vv-as="title" name="title" :class="{'form-control': true, 'is-invalid': errors.has('title')}" v-model="title" placeholder="Title">
            <div v-show="errors.has('title')" class="invalid-feedback">{{ errors.first('title') }}</div>
        </div>
        <div class="form-group col-md-6">
            <label for="level">Level:</label>
            <select v-model="level" name="level" data-vv-validate-on="none" v-validate="'required'" data-vv-as="level" @change="handleChange" :class="{'form-control': true, 'is-invalid': errors.has('level')}">
                <option value="High school">High school</option>
                <option value="Undergraduate 1-2">Undergraduate 1-2</option>
                <option value="Undergraduate 3-4">Undergraduate 3-4</option>
                <option value="Masters">Masters</option>
                <option value="PHD">PHD</option>
            </select>
            <div v-show="errors.has('level')" class="invalid-feedback">{{ errors.first('level') }}</div>
        </div>

        <div class="form-group col-md-6">
            <label for="format">Format:</label>
            <select v-model="format" name="format" data-vv-validate-on="none" v-validate="'required'" data-vv-as="format" :class="{'form-control': true, 'is-invalid': errors.has('format')}" @change="handleChange">
                <option value="APA">APA</option>
                <option value="MLA">MLA</option>
                <option value="CHICAGO">CHICAGO</option>
                <option value="HARVARD">HARVARD</option>
                <option value="OTHERS">OTHERS</option>
            </select>
            <div v-show="errors.has('format')" class="invalid-feedback">{{ errors.first('format') }}</div>
        </div>
        <div class="form-group col-md-6">
            <label for="budget">Budget:</label>
            <select v-model="budget" name="budget" data-vv-validate-on="none" v-validate="'required'" data-vv-as="budget" :class="{'form-control': true, 'is-invalid': errors.has('budget')}" @change="handleChange">
                <option value="$5-$10">Mini budget($5-$10)</option>
                <option value="$10-$30">Micro budget($10-$30)</option>
                <option value="$30-$100">Standard budget($30-$100)</option>
                <option value="$100-$250">Medium budget($100-$250)</option>
                <option value="$250-$500">Large budget($250-$500)</option>
                <option value="$500-$1000">Major budget($500-$1000)</option>
            </select>
            <div v-show="errors.has('budget')" class="invalid-feedback">{{ errors.first('budget') }}</div>
        </div>
        <div class="col-md-8">
            <div v-if="estimatePricing.pp > 0" id="pricingcalc">
                <div class="row">
                    <div class="col-md-6">
                        <div class="m-calculatorMain__priceTitle">
                            Our Price <svg class="m-tooltip__icon u-icon u-icon--small u-icon--drop" data-toggle="tooltip" data-placement="top" title="Competitors' price is calculated using statistical data on writers' offers on Studybay"><use xlink:href="/images/ico-lib.svg#ico-question"></use></svg>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="m-calculatorMain__priceTitle">
                            Competitors' price <svg class="m-tooltip__icon u-icon u-icon--small u-icon--drop" data-toggle="tooltip" data-placement="top" title="We've gathered and analyzed the data on average prices offered by competing websites"><use xlink:href="/images/ico-lib.svg#ico-question"></use></svg>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="m-calculatorMain__price m-calculatorMain__price--best" data-js="price-container">
                            <div class="m-calculatorMain__priceValue" data-js="price-our-container">
                                $ <span data-js="price-our-value">{{ estimatePricing.price }}</span>
                                <span class="m-calculatorMain__bestPrice">Best Price!</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="m-calculatorMain__price">
                            <div class="m-calculatorMain__priceValue m-calculatorMain__priceValue--lineThrough" data-js="price-their-container">
                                $ <span data-js="price-their-value">{{ estimatePricing.others }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <button type="submit" @click.prevent="FirstStep()" class="btn btn-primary btn-md btn-block"><i class="fa fa-arrow-left"></i>  BACK</button>
            <button type="submit" class="btn btn-success btn-md btn-block"> NEXT <i class="fa fa-arrow-right"></i></button>
        </div>
     </div>
    </form>
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
        inject: ['$validator'],
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

            ThirdStep(){
                this.$validator.validateAll({
                    'title': this.calculatorvalues.title
                }).then((result) => {
                    if (result) {
                        this.$store.commit(SETSPINNER_REQUEST, true)
                        this.$store.commit(SET_STEP, 'three')
                    }
                })
            }
        }

    }
</script>

<style scoped>
    .m-calculatorMain__price--best {
        border-bottom: 4px solid #4587ca;
    }
    .m-calculatorMain__price {
        text-align: center;
        padding: 0 0 20px 0;
    }

    .m-calculatorMain__priceValue {
        position: relative;
        display: inline-block;
        color: #464748;
        line-height: 52px;
        font-size: 38px;
        font-weight: 600;
    }
    .m-calculatorMain__bestPrice {
        display: block;
        position: absolute;
        top: 50%;
        right: -53px;
        margin-top: -24px;
        width: 48px;
        height: 48px;
        padding: 11px 10px 10px 10px;
        border-radius: 50%;
        background-color: #a0c479;
        color: #fff;
        text-align: center;
        font-size: 10px;
        font-weight: 600;
        line-height: 12px;
    }

    .m-calculatorMain__priceValue--lineThrough {
        position: relative;
        color: #6b6b6c;
        font-size: 36px;
        font-weight: 300;
    }
    .m-calculatorMain__priceValue {
        position: relative;
        display: inline-block;
        color: #464748;
        line-height: 52px;
        font-size: 38px;
        font-weight: 600;
    }


    .m-calculatorMain__priceValue--lineThrough::after {
        content: '';
        display: block;
        position: absolute;
        top: 50%;
        left: -10px;
        right: -10px;
        margin-top: -1px;
        height: 2px;
        background-color: rgba(147,147,147,.4);
    }

    .m-calculatorMain__priceTitle {
        color: #464748;
        font-size: 14px;
        font-weight: 600;
        text-align: center;
    }
    svg:not(:root) {
    overflow: hidden;
    }
    .u-icon--drop {
        margin: 0;
    }
    .u-icon--small {
        width: 16px;
        height: 16px;
    }
    .u-icon {
        display: inline-block;
        position: relative;
        height: 20px;
        width: 20px;
        fill: currentColor;
        vertical-align: middle;
        top: -1px;
        margin-right: 5px;
    }
    .m-tooltip__icon {
        display: inline-block;
        color: #989c9c;
        cursor: help;
    }
    .u-icon--drop {
        margin: 0;
    }
    .u-icon--small {
        width: 16px;
        height: 16px;
    }
    .u-icon {
        display: inline-block;
        position: relative;
        height: 20px;
        width: 20px;
        fill: currentColor;
        vertical-align: middle;
        top: -1px;
        margin-right: 5px;
    }
    .calculator label {
        text-align: left;
    }
    .calculator .inputtext {
        -webkit-border-radius: 6px;
        border-radius: 6px;
        background-color: #fff;
        -webkit-box-shadow: 0 2px 6.51px 0.49px rgba(11, 11, 123, .35);
        box-shadow: 0 2px 6.51px 0.49px rgba(11, 11, 123, .35);
        color: #4573c1;
        font-weight: bold;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .button-main-back {
        background-color: #bcbfbe;
        border: none;
        -webkit-border-radius: 30px;
        border-radius: 30px;
        -webkit-box-shadow: 0 2px 3.72px 0.28px rgba(0, 0, 0, .3);
        box-shadow: 0 2px 3.72px 0.28px rgba(0, 0, 0, .3);
        cursor: pointer;
        text-transform: uppercase;
        outline: 0;
        font-weight: 700;
        margin-right: 0px;
        width: 100px;
        height: 45px;
        font-family: Lato;
        font-size: 16px;
        text-decoration: none;
        text-align: center;
        -webkit-transition: background-color .3s, -webkit-box-shadow .3s;
        transition: background-color .3s, -webkit-box-shadow .3s;
        transition: background-color .3s, box-shadow .3s;
        transition: background-color .3s, box-shadow .3s, -webkit-box-shadow .3s;
    }

    .button-main-calc {
        background-color: #0becaa;
        border: none;
        -webkit-border-radius: 30px;
        border-radius: 30px;
        -webkit-box-shadow: 0 2px 3.72px 0.28px rgba(0, 0, 0, .3);
        box-shadow: 0 2px 3.72px 0.28px rgba(0, 0, 0, .3);
        cursor: pointer;
        text-transform: uppercase;
        outline: 0;
        font-weight: 700;
        margin-right: 0px;
        width: 100px;
        height: 45px;
        font-family: Lato;
        font-size: 16px;
        text-decoration: none;
        text-align: center;
        -webkit-transition: background-color .3s, -webkit-box-shadow .3s;
        transition: background-color .3s, -webkit-box-shadow .3s;
        transition: background-color .3s, box-shadow .3s;
        transition: background-color .3s, box-shadow .3s, -webkit-box-shadow .3s;
    }
</style>
