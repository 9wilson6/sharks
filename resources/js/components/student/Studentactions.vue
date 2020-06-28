<template>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info fa-fw"></i> Actions
    </div>
    <div class="panel-body">
            <div v-if="(orderdetails.status == 4  || orderdetails.status == 5|| orderdetails.status == 3)" class="col-lg-2">
                <a @click="clickChat(orderdetails.tutor_id)" class="btn btn-success btn-block" >Chat I'm Online</a>
            </div>
            <div v-if="(orderdetails.status == 6  || orderdetails.status == 4 || orderdetails.status == 5|| orderdetails.status == 3 || orderdetails.status == 8)" class="col-lg-2">
                <a v-bind:href="'/home/messages/create/' +orderdetails.tutor_id" class="btn btn-primary btn-block">Message</a>
            </div>  
            <div v-if="(orderdetails.status == 5)" onclick="return confirm('Do you really want to Release Payment?');" class="col-lg-2">
                <a v-bind:href="'/home/payments/release/' +orderdetails.id" class="btn btn-warning btn-block">Release payment</a>
            </div>

            <div v-if="(orderdetails.status == 5)" class="col-lg-2">
                <a v-bind:href="'/home/orders/revision/' +orderdetails.id" class="btn btn-danger btn-block">Request revision</a>
            </div>

            <!-- <div v-if="(orderdetails.status == 5  || orderdetails.status == 3 || hasdeadlinepassed)" class="col-lg-2"> -->
            <div v-if="(orderdetails.status == 5  || orderdetails.status == 3)" class="col-lg-2">
                <a v-if="!orderdetails.dispute" v-bind:href="'/home/orders/dispute/' +orderdetails.id" class="btn btn-warning btn-block">File dispute</a>
                <a v-bind:href="'/home/orders/withdraw-dispute/' +orderdetails.id" onclick="return confirm('Do you really want to Withdraw this dispute?');" class="btn btn-warning btn-block" v-else>Withdraw Dispute</a>
            </div>
            <div v-if="(orderdetails.status == 5 || orderdetails.status == 3 || orderdetails.status == 6 || orderdetails.status == 0)">
                <div v-if="showreviewtutor" class="col-lg-2">
                    <a v-bind:href="'/home/orders/rate-tutor/' +orderdetails.id" class="btn btn-warning btn-block">Review scholar</a>
                </div>                
            </div>
    </div>
</div>
</template>
<script>
import moment from 'moment'
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            useronline: 'offline',
        }
    },
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails',
            getuser: 'GetUser'
        }),
        hasdeadlinepassed(){
           if (!_.isEmpty(this.orderdetails)) {
                let deadline = moment(this.orderdetails.homedate).isBefore(moment(), "day")
                console.log(deadline)                
                return deadline                
            } 
        },
        showreviewtutor(){
            if (!_.isEmpty(this.orderdetails)) {
                let tutor_hasratings = _.find(this.orderdetails.ratings, ['rateable_id', Number(this.orderdetails.tutor_id)])
                if(_.isObject(tutor_hasratings)){
                    return false
                }else{
                    return true
                }                
            }
        }
    },    
    methods: {
        clickChat: function (event) {
            jqcc.cometchat.chatWith(event);
        }
    },
    mounted(){

        /* setInterval(function () {
            axios.get('/cometchat/cometchat_getid.php?userid=' +this.orderdetails.tutor_id)
                .then(response => this.useronline = response.data.s);                
        }.bind(this), 2000); */
    }
}
</script>