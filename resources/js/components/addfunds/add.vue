<template>
    <div>
        <div v-show="paymenterror" class="alert alert-danger">
            <strong>{{ paymenterror }}</strong>
        </div>
        <form @submit.prevent="addFunds()">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="deposit-funds__summ">
                    <div :class="{ 'form-group': true, 'has-error': amounterror, 'has-feedback': amounterror }">
                        <label for="amount">Amount (USD):</label>
                        <input type="number" class="form-control" v-on:keyup="calculateFee" name="amount" v-model="amount" step="0.01" required>
                        <span v-show="amounterror" class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <div v-show="amounterror" class="help-block with-errors"><strong>{{ amounterror }}</strong></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-8 col-sm-12">
                <div class="deposit-funds__select-method">
                <label class="deposit-funds__method" @click="choosen('paypal')" :chosen="checked === 'paypal'">
                    <input type="radio" name="paymentmethod" id="paymentmethod" v-model="paymentmethod" value="paypal" checked>
                    <div class="radio"></div>
                    <div class="deposit-funds__method-image">
                        <img src="/img/addfunds/paypal.png" alt="">
                    </div>
                    <div class="deposit-funds__method-info">
                        <span class="deposit-funds__method-name">
                            PayPal
                        </span>
                        <div class="deposit-funds__method-taxes">
                            <span>service commission</span>
                            <span name="emoney">{{ fee }}</span>&nbsp;$
                            <br>
                        </div>
                    </div>
                </label>
                <label class="deposit-funds__method" @click="choosen('visa_master_card')" :chosen="checked === 'visa_master_card'">
                    <input type="radio" name="paymentmethod" id="paymentmethod" v-model="paymentmethod" value="visa_master_card">
                    <div class="radio"></div>
                    <div class="deposit-funds__method-image">
                        <img src="/img/addfunds/card.png" alt="">
                    </div>
                    <div class="deposit-funds__method-info">
                        <span class="deposit-funds__method-name">
                            Visa/MasterCard
                        </span>
                        <div class="deposit-funds__method-taxes">
                            <span>service commission</span>
                            <span name="emoney">{{ fee }}</span>&nbsp;$
                            <br>
                        </div>
                    </div>
                </label>
            </div>
            </div>
        </div>
        <div class="deposit-funds__bottom pull-right">
            <button v-if="!submitted" class="u-button u-button--green">Proceed to pay {{ amountplusfees }} 〉</button>
            <button disabled class="btn u-button u-button--green" v-else><i class='fa fa-spinner fa-spin '></i> Processing please wait... </button>
        </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            paymentmethod: 'paypal',
            checked: 'paypal',
            amount: null,
            fee: null,
            amountplusfees: '',
            amounterror: null,
            paymenterror: null,
            submitted: false
        }
    },
    mounted(){
        if (this.$route.query.amount) {
            console.log(this.$route.query.amount);
            this.amount = this.$route.query.amount
            this.calculateFee()
        }
    },
    methods: {
        choosen(check){
            this.checked = check
        },
        calculateFee(){
            this.fee = parseFloat(0.07 * this.amount).toFixed(2)
            this.amountplusfees = parseFloat(parseFloat(this.amount) + parseFloat(this.fee)).toFixed(2)
        },
        addFunds(){
            this.submitted = false
            this.paymenterror = null
            this.amounterror = null
            if (this.amount < 1) {
                this.amounterror = 'Add more than $1'
            }else {
                this.submitted = true
                axios.post('/home/payments/paypal', {
                    amount: this.amount,
                    totalamount: this.amountplusfees,
                    fee: this.fee
                })
                .then(result => {
                    window.location = result.data.link
                })
                .catch((err) => {
                    this.submitted = false
                    let firsterrror = err.response.data.errors[Object.keys(err.response.data.errors)[0]][0]
                    this.paymenterror = firsterrror
                })
            }
        }
    }
}
</script>

<style scoped>
.deposit-funds__summ {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -webkit-flex-flow: row nowrap;
    -moz-box-orient: horizontal;
    -moz-box-direction: normal;
    -ms-flex-flow: row nowrap;
    flex-flow: row nowrap;
    -webkit-box-align: baseline;
    -webkit-align-items: baseline;
    -moz-box-align: baseline;
    -ms-flex-align: baseline;
    align-items: baseline;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    padding: 13px 75px;
    margin-top: 36px;
    background-color: rgba(162,198,121,.15);
    border: 1px solid #a2c679;
    border-radius: 5px;

}

.deposit-funds__select-method {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -webkit-flex-flow: row wrap;
    -moz-box-orient: horizontal;
    -moz-box-direction: normal;
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -moz-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    margin-top: 36px;

}

.deposit-funds__method[chosen="true"] {
    border: 1px solid #4786c8;
    background-color: rgba(71,134,200,.15);

}
.deposit-funds__method {

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -webkit-flex-flow: row nowrap;
    -moz-box-orient: horizontal;
    -moz-box-direction: normal;
    -ms-flex-flow: row nowrap;
    flex-flow: row nowrap;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -moz-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: start;
    -webkit-justify-content: flex-start;
    -moz-box-pack: start;
    -ms-flex-pack: start;
    justify-content: flex-start;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    cursor: pointer;
    padding: 20px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 1px solid #e1e1e1;
    margin-bottom: 16px;

}

.deposit-funds__method input[type="radio"] {
    display: none;
}

[type="checkbox"], [type="radio"] {
    box-sizing: border-box;
    padding: 0;
}

.deposit-funds__method input[type="radio"]:checked + .radio {

    background-color: #4786c8;
    -webkit-box-shadow: inset 0 0 0 4px #fff;
    -moz-box-shadow: inset 0 0 0 4px #fff;
    box-shadow: inset 0 0 0 4px #fff;

}
.deposit-funds__method .radio {

    width: 16px;
    height: 16px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    border: 1px solid #e1e1e1;
    -webkit-flex-shrink: 0;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    background-image: none;
    background-color: #fff;

}

.radio {

    background: url(/img/addfunds/krug.png) center no-repeat;
        background-color: rgba(0, 0, 0, 0);
        background-image: url("/img/addfunds/krug.png");
    width: 20px;
    height: 20px;
    display: inline-block;
    cursor: pointer;

}

.deposit-funds__method > :not(:last-child) {

    margin-right: 8px;

}
img {

    border-style: none;

}

.deposit-funds__method {

    cursor: pointer;

}
.deposit-funds__method-name {

    font-size: 14px;

}

.deposit-funds__method-taxes {

    color: #8d8d8d;
    font-family: "Open Sans";
    font-size: 13px;
    font-weight: 400;

}

.deposit-funds__method-taxes {

    color: #8d8d8d;
    font-family: "Open Sans";
    font-size: 13px;
    font-weight: 400;

}

.deposit-funds__bottom {

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -webkit-flex-flow: row nowrap;
    -moz-box-orient: horizontal;
    -moz-box-direction: normal;
    -ms-flex-flow: row nowrap;
    flex-flow: row nowrap;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -moz-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    margin: 0 32px;
    padding: 20px 0;
    border-top: 1px solid #e1e1e1;

}

.u-checkButton {

    display: inline-block;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;

}
.u-checkButton {

    display: inline-block;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;

}

.u-checkButton input {

    display: none;

}
.u-checkButton input {

    display: none;

}
[type="checkbox"], [type="radio"] {

    box-sizing: border-box;
    padding: 0;

}
button, input {

    overflow: visible;

}
button, input, optgroup, select, textarea {

    font-family: sans-serif;
    font-size: 100%;
    line-height: 1.15;
    margin: 0;

}

.u-checkButton span {

    display: inline-block;
    position: relative;
    padding-left: 30px;
    min-height: 20px;

}
.u-checkButton span {

    display: inline-block;
    position: relative;
    padding-left: 30px;
    min-height: 20px;

}
.deposit-funds__agreement {

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -webkit-flex-flow: row nowrap;
    -moz-box-orient: horizontal;
    -moz-box-direction: normal;
    -ms-flex-flow: row nowrap;
    flex-flow: row nowrap;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -moz-box-align: center;
    -ms-flex-align: center;
    align-items: center;

}

.deposit-funds {

    color: #333;

}

.u-button--green {

    color: #fff;
    background-color: #a2c679;

}
.u-button {

    position: relative;
    display: inline-block;
    height: 40px;
    line-height: 40px;
    padding: 0 30px;
    color: #fff;
    border: none;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-transform: uppercase;
    -webkit-transition: background-color .3s ease,color .2s ease;
    -o-transition: background-color .3s ease,color .2s ease;
    -moz-transition: background-color .3s ease,color .2s ease;
    transition: background-color .3s ease,color .2s ease;
    background-color: #139415;

}
button, html [type="button"], [type="reset"], [type="submit"] {

    -webkit-appearance: button;

}
button, select {

    text-transform: none;

}
button, input {

    overflow: visible;

}
button, input, optgroup, select, textarea {

    font-family: sans-serif;
    font-size: 100%;
    line-height: 1.15;
    margin: 0;

}
</style>

