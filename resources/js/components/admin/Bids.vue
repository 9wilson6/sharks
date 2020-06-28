<template>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Scholar</th>
                <th>Rating</th>
                <th>Bid Amt + 10% fee</th>
                <th>Completion Time (Pacific Time)</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(bid, index) in tutorbids" :key="index">
                <td><a href="#">{{ bid.tutor.name }}</a></td>
                <td><a href="#"><img src="/img/4halfstars.png" /> {{ bid.tutorratings }} reviews</a></td>
                <td><strong>${{ bid.amount }}</strong> <a onclick="return confirm('Do you really want to Delete this bid?');" v-bind:href="'/admin/bids/delete/' +bid.id"><strong>Delete bid</strong></a></td>
                <td>{{ bid.homedate | duedate }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>
<script>
    import { mapGetters } from 'vuex'
    export default {
        data() {
            return {
                tutorbids: [],
                ratings: '',
                paypal: '',
                ratings: '',
                useronline: ''
            }
        },
        computed: {
            ...mapGetters({
                orderdetails: 'GetOrderDetails',
                user: 'GetUser'
            })
        },
        filters: {
            duedate(date) {
                return moment(date).format('LLLL')
            }
        },
        created() {
            Echo.private(`adminbids.${this.orderdetails.id}`)
            .listen('AdminBidsUpdated', (e) => {
                this.fetchBids()
            });
        },
        methods: {
            fetchBids(){
                axios.get('/admin/bids/api/' + this.orderdetails.id)
                .then(response => this.tutorbids = response.data)
            },
            clickChat: function (theuser) {
                jqcc.cometchat.chatWith(theuser);
            }

        },
        mounted() {
            this.fetchBids()            
        }
    }

</script>