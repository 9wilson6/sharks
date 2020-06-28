<template>
    <div class="stepwizard">
        <div class="stepwizard-row">
            <div class="stepwizard-step">
                <button type="button" class="btn btn-default btn-circle" :class="{ 'btn-primary': orderdetails.status == 1 }" disabled="disabled">1</button>
                <p>Open for Bidding</p>
            </div>

            <div class="stepwizard-step">
                <button type="button" class="btn btn-default btn-circle" :class="{ 'btn-primary': orderdetails.status == 4 }" disabled="disabled">2</button>
                <p>In Progress</p>
            </div> 

            <div class="stepwizard-step">
                <button type="button" class="btn btn-default btn-circle" :class="{ 'btn-primary': orderdetails.status == 5 }" disabled="disabled">3</button>
                <p>Completed</p>
            </div>

            <div class="stepwizard-step">
                <button type="button" class="btn btn-default btn-circle" :class="{ 'btn-primary': orderdetails.status == 8 }" disabled="disabled">4</button>
                <p>Under revision</p>
            </div>

            <div class="stepwizard-step">
                <button type="button" class="btn btn-default btn-circle" :class="{ 'btn-primary': orderdetails.status == 7 }" disabled="disabled">5</button>
                <p>Refunded</p>
            </div>            

            <div class="stepwizard-step">
                <button type="button" class="btn btn-default btn-circle" :class="{ 'btn-primary': orderdetails.status == 3 }" disabled="disabled">6</button>
                <p>Disputed</p>
            </div>

            <div class="stepwizard-step">
                <button type="button" class="btn btn-default btn-circle" :class="{ 'btn-primary': orderdetails.status == 6 }" disabled="disabled">7</button>
                <p>Closed</p>
            </div>            
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails'
        })
    },
    mounted(){}
}
</script>
<style>
    .stepwizard-step p {
        margin-top: 10px;    
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;     
        width: 100%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;    
    }
    .stepwizard-step {    
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
</style>
