<template>
    <div class="bg-gray-300 rounded p-3" style="box-shadow: 0 0 15px rgba(0, 0, 0, 1);" v-cloak>
        <div id="calculatorhome" class="px-2 text-center">
            <h2 class="md:text-left">Get instant homework help</h2>
            <a-spin :spinning="GetSpinning" tip="Please wait..." size="large">
                <step-one v-if="GetStep == 'one'"></step-one>
                <step-two v-if="GetStep == 'two'"></step-two>
                <step-three v-if="GetStep == 'three'"></step-three>
            </a-spin>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import {
    SET_USER,
    EMAILADDRESS_REQUEST
} from '../../../store/actions/calculator'
import StepOne from "./steps/stepone.vue";
import StepTwo from "./steps/steptwo.vue";
import StepThree from "./steps/stepthree.vue";
export default {
    props: ['user'],
    components: {
        'step-one': StepOne,
        'step-two': StepTwo,
        'step-three': StepThree
    },
    computed: {
        ...mapGetters(['GetStep', 'GetSpinning'])
    },
    mounted() {
        if (this.user === undefined) {
            this.$store.commit(SET_USER, null);
        } else {
            this.$store.commit(SET_USER, this.user);
            this.$store.commit(EMAILADDRESS_REQUEST, this.user.email)
        }
    },
    methods: {
        onChange(date, dateString) {
            console.log(date, dateString);
        },
        handleChange(value) {
            console.log(`selected ${value}`);
        }
    }
}
</script>
<style>
@import './antd.css'
</style>

<style scoped>
  /* [v-cloak] { display: none; }
  .spin-content{
    border: 1px solid #91d5ff;
    background-color: #e6f7ff;
    padding: 30px;
  } */
</style>
