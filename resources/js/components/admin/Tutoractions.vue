<template>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info fa-fw"></i> Actions
    </div>
    <div class="panel-body">
            <div v-if="(orderdetails.status == 1 || orderdetails.status == 4  || orderdetails.status == 5 || orderdetails.status == 3|| orderdetails.status == 8)" class="col-lg-2">
                <a @click="clickChat(orderdetails.student_id)" class="btn btn-success btn-block" >Chat I'm Online</a>
            </div>
            <div v-if="(orderdetails.status != 2  || orderdetails.status != 7)" class="col-lg-2">
                <a :href="'/account/messages/create/' +orderdetails.student_id" class="btn btn-primary btn-block">Message</a>
            </div>
            <div v-if="(orderdetails.status == 4  || orderdetails.status == 3 || orderdetails.status == 5 || orderdetails.status == 8)" class="col-lg-2">
                <a :href="'/account/payments/refund/' +orderdetails.id" onclick="return confirm('Do you really want to refund this order. This action is undone?');" class="btn btn-warning btn-block">Refund</a>
            </div>
            <div v-if="(orderdetails.status == 5 || orderdetails.status == 6)">
                <div v-if="showreviewstudent" class="col-lg-2">
                    <a v-bind:href="'/account/orders/rate-student/' +orderdetails.id" class="btn btn-warning btn-block">Review Student</a>
                </div>                
            </div>
            <div v-if="(orderdetails.status == 4  || orderdetails.status == 5 || orderdetails.status == 8)" class="col-lg-2">
                <a :href="'/account/solution/add/' +orderdetails.id" class="btn btn-warning btn-block">Upload solution</a>
            </div>
    </div>
</div>
</template>

<script>
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
        showreviewstudent(){
            if (!_.isEmpty(this.orderdetails)) {
                let student_hasratings = _.find(this.orderdetails.ratings, ['rateable_id', Number(this.orderdetails.student_id)])
                if(_.isObject(student_hasratings)){
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