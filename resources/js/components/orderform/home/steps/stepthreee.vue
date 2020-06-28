<template>
     <form @submit.prevent="FinalStep()">
     <div class="row">
         <div class="form-group col-md-12">
            <label for="orderdetails">Order details:</label>
            <text-editor data-vv-validate-on="none" name="orderdetails" data-vv-as="order details" v-validate="'required'" v-model="orderdetails" api-key="q1ba0baz01vm4f2mhc4194dfd9b2sfalus1cgl5qsqa11281" :init="{plugins: 'wordcount'}" :class="{'form-control': true, 'is-invalid': errors.has('orderdetails')}"></text-editor>
            <small v-show="errors.has('orderdetails')" class="form-text text-danger">{{ errors.first('orderdetails') }}</small>
        </div>
        <div class="form-group col-md-12">
            <div class="form-check">
                <input :checked="termsandconditions" v-validate="'required'" id="termsandconditions" name="termsandconditions" v-model="termsandconditions" @change="onChange" :class="{'form-check-input': true, 'is-invalid': errors.has('termsandconditions')}" type="checkbox">
                <label class="form-check-label" for="termsandconditions"> I have read and agree to <a href="#">Terms and Condition</a>, <a href="#">Refund Policy</a>, <a href="#">Privacy Policy</a> and <a href="#">Cookie Policy</a></label>
            </div>
        </div>
        <div class="col-md-4">
            <button type="submit" @click.prevent="SecondStep()" class="btn btn-primary btn-md btn-block"><i class="fa fa-arrow-left"></i>  BACK</button>
        </div>
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">            
            <button type="submit" class="btn btn-success btn-md btn-block"> PROCEED <i class="fa fa-arrow-right"></i></button>
        </div>
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
    </form>
</template>
<script>
    import tinymce from 'tinymce';
    // A theme is also required
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
        inject: ['$validator'],
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
            FinalStep(){
                this.$validator.validateAll({
                    'orderdetails': this.orderdetails
                }).then((result) => {
                    if (result) {
                        this.$store.commit(SETSPINNER_REQUEST, true)
                        this.$store.dispatch(POSTHOMEWORK_REQUEST, this.calculatorvalues)
                    }
                })
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