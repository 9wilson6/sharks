<template>
    <div>
        <form @submit.prevent="SecondStep()" novalidate>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="emailaddress">Email Address:</label>
                    <input :disabled="loggedin" data-vv-validate-on="none" v-validate="'required|email'" data-vv-as="email address" name="emailaddress" :class="{'form-control': true, 'is-invalid': errors.has('emailaddress')}" v-model="emailaddress" placeholder="Email address">
                    <div v-show="errors.has('emailaddress')" class="invalid-feedback">{{ errors.first('emailaddress') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="deadline">Deadline: <svg class="m-tooltip__icon u-icon u-icon--small u-icon--drop" data-toggle="tooltip" data-placement="right" title="Specify when you would like to receive the paper from your writer. Make sure you leave a few more days if you need the paper revised. You'll get 20 more warranty days to request any revisions, for free."><use xlink:href="/images/ico-lib.svg#ico-question"></use></svg></label>
                    <datetime
                        type="datetime"
                        v-model="deadline"
                        name="deadline"
                        data-vv-validate-on="none"
                        data-vv-as="deadline"
                        placeholder="Select Deadline"
                        :input-class="{'form-control': true, 'is-invalid': errors.has('deadline')}"
                        :format="{ year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit' }"
                        :phrases="{ok: 'Select Deadline', cancel: 'Exit'}"
                        :hour-step="2"
                        :minute-step="15"
                        :week-start="7"
                        use12-hour
                        auto></datetime>
                        <small v-show="errors.has('deadline')" class="form-text text-danger">{{ errors.first('deadline') }}</small>
                        <!-- <small v-show="errors.has('deadline')" class="form-text text-danger">Kindly provide a date after 24 hours</small> -->
                        <small v-show="!errors.has('deadline') && deadline && datefromnowpast" class="form-text text-muted">Your task will be completed in {{ deadline | datefromnow }}</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="subject">Subject:</label>
                    <select v-model="subject" name="subject" data-vv-validate-on="none" v-validate="'required'" data-vv-as="subject" @change="handleChange" :class="{'form-control': true, 'is-invalid': errors.has('subject')}">
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
                    <div v-show="errors.has('subject')" class="invalid-feedback">{{ errors.first('subject') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="numpages">Pages: <span style="color:blue; font-weight: bold;">Words: <span v-html="numpages * 275"></span></span></label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text" @click.prevent="changePages('minus')">-</div>
                        </div>
                        <input name="numpages" disabled="disabled" v-model="numpages" type="text" class="form-control col-md-3 numpages">
                        <div class="input-group-append">
                            <span class="input-group-text" @click.prevent="changePages('plus')">+</span>
                        </div>
                    </div>
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
                    <button type="submit" href="#" class="btn btn-success btn-lg btn-block"> NEXT <i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
        </form>
    </div>

</template>
<script>
    import Vue from 'vue'
    import moment from 'moment'
    import Datetime from 'vue-datetime'
    // You need a specific loader for CSS files
    import 'vue-datetime/dist/vue-datetime.css'
    import { mapGetters } from 'vuex'
    import {
        EMAILADDRESS_REQUEST,
        DEADLINE_REQUEST,
        SUBJECT_REQUEST,
        SETSPINNER_REQUEST,
        NUMPAGES_REQUEST,
        SET_STEP,
        ESTIMATEPRICING
    } from '../../../../store/actions/calculator'
    Vue.use(Datetime)
    export default {
        inject: ['$validator'],
        created() {
            this.$validator.extend('aftertwentyfour', {
                getMessage(field, val) {
                    return 'Minimun deadline is 24 hours'
                },
                validate(value, field) {
                    let twentyfour = moment().add(23, 'h')
                    return moment(value).isAfter(twentyfour)
                }
            })
            this.$validator.attach({
                name: 'deadline',
                rules: 'aftertwentyfour|required',
                getter: () => this.calculatorvalues.deadline
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
            SecondStep(){
                this.$validator.validateAll({
                    emailaddress: this.calculatorvalues.emailaddress,
                    deadline: this.calculatorvalues.deadline
                }).then((result) => {
                    if (result) {
                        this.$store.commit(SETSPINNER_REQUEST, true)
                        this.$store.commit(SET_STEP, 'two')
                    }
                })
            }
        }
    }
</script>
<style scoped>
    .input-group-text {
        cursor: pointer !important;
        font-weight: bold;
        color: #000;
    }

    .numpages{
        text-align: center;
    }

    .btn {font-size: 20px !important;}

    .btn-success:not(:disabled):not(.disabled):active, .btn-success:not(:disabled):not(.disabled).active, .show > .btn-success.dropdown-toggle {
        color: #fff;
        background-color: #1e7e34 !important;
        border-color: #1c7430;
    }

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
    .count {
        width: 54px;
        line-height: 2;
        text-align: center;
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
        width: 220px;
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
