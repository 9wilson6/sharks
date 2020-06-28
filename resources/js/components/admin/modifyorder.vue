<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-3">
                <a :href="'/admin/orderuploads/upload/'+orderdetails.id" class="btn btn-primary btn-block"><strong>Upload Files</strong></a>
            </div>
            <div class="col-lg-3">
                <a :href="'/admin/orders/edit/'+orderdetails.id" class="btn btn-warning btn-block"><strong>Edit your Order</strong></a>
            </div>
            <div class="col-lg-3">
                <a :href="'/admin/orders/delete/'+orderdetails.id" onclick="return confirm('Are you sure you want to delete this order. This action can not be undone. BE CAREFUL');" class="btn btn-danger btn-block"><strong>Cancel Order</strong></a>
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
