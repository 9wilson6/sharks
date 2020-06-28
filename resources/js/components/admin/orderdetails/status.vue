<template>
    <div>
        <div v-if="orderdetails.status == 1" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Project is Live and Open for Bidding</strong>
        </div>
        <div v-if="orderdetails.status == 2" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Project has been Cancelled</strong>
        </div>
        <div v-if="orderdetails.status == 3" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Project Disputed</strong>
        </div>
        <div v-if="orderdetails.status == 4" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Project in Progress</strong>
        </div>
        <div v-if="orderdetails.status == 5" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Project Completed</strong>
        </div>
        <div v-if="orderdetails.status == 6" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Project Closed</strong>
        </div>
        <div v-if="orderdetails.status == 7" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Project has been Refunded</strong>
        </div>
        <div v-if="orderdetails.status == 8" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Project under revision</strong>
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
