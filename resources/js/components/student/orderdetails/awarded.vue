<template>
    <div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bell-o fa-fw"></i> Award details
    </div>
    <div class="panel-body">
     <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Awarded to</th>
                    <th v-if="orderdetails.tutor"><a :href="'/home/account/scholar-profile/'+orderdetails.tutor.id">{{ orderdetails.tutor.name }}</a></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Amount</strong></td>
                    <td>$ {{ orderdetails.agreed_amount }}</td>
                </tr>
                <tr>
                    <td><strong>Date awarded</strong></td>
                    <td>{{ orderdetails.date_awarded | datFormat }}</td>
                </tr>             
            </tbody>
        </table>
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
    filters: {
        datFormat: function(dat){
            return moment(dat).format('LLLL');
        }
    },
    mounted(){}
}
</script>