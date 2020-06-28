<template>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info fa-fw"></i> Solutions
    </div>
    <p></p>
       <button v-if="!orderdetails.solutions" class="btn btn-warning"><i>Project does not have any solution</i></button>
    
       <a v-for="(solution, index) in orderdetails.solutions" :key="index" :href="'/home/orderuploads/get/solution/' +solution.order_id+'/' +solution.filename" class="btn btn-danger" v-else>{{ solution.filename }}</a>    
    <p></p>
</div>    
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails'
        })
    }
}
</script>
