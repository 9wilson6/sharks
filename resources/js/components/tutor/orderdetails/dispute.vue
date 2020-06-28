<template>
    <div class="alert alert-danger">
        <strong><u>Reasons for Dispute:</u> {{ orderdetails.dispute.reason }}</strong><br>
        <strong><u>Time remaining before dispute escalates:</u> {{ orderdetails.dispute.created_at }}</strong>
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