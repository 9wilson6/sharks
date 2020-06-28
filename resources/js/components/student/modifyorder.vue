<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-3">
                <a :href="'/home/account/scholars-online'" class="btn btn-success btn-block">Chat With Scholars</a>
            </div>
            <div class="col-lg-3">
                <a :href="'/home/orderuploads/upload/'+orderdetails.id" class="btn btn-primary btn-block">Upload Files</a>
            </div>
            <div class="col-lg-3">
                <a :href="'/home/orders/edit/'+orderdetails.id" class="btn btn-warning btn-block">Edit your Order</a>
            </div>
            <div v-if="orderdetails.status == 1" class="col-lg-3">
                <a :href="'/home/orders/delete/'+orderdetails.id" onclick="return confirm('Do you really want to delete this order. This action will be undone?');" class="btn btn-danger btn-block">Cancel Order</a>
            </div>
            <div class="col-lg-3" v-if="orderdetails.status != 1">
                <extend-deadline></extend-deadline>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import extenDeadline from "./extendeadline";
export default {
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails'
        })
    },
    components: {
        'extend-deadline': extenDeadline
    },
    mounted(){}
}
</script>
