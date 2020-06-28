<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-3">
                <a href="#" class="btn btn-success btn-block">Chat With Scholars</a>
            </div>
            <div class="col-lg-3">
                <a href="#" class="btn btn-primary btn-block">Upload Files</a>
            </div>
            <div class="col-lg-3">
                <a href="#" class="btn btn-warning btn-block">Edit your Order</a>
            </div>
            <div class="col-lg-3">
                <a href="#" class="btn btn-danger btn-block">Cancel Order</a>
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
