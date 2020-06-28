<template>
    <div class="table-responsive">
        <notifications group="newbid" />
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Scholar</th>
                    <th>Rating</th>
                    <th>Bid Amt + 10% fee</th>
                    <th>Completion Time (Pacific Time)</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(bid, index) in tutorbids" :key="index">
                    <td>
                        <a :href="'/home/payments/pay/order/' +bid.id" :onclick="'return confirm(\'Do you really want to award tutor '+bid.tutor.name+' this order?\')'" class="btn btn-danger btn-block">Award Order</a>
                        <a @click="clickChat(bid.tutor_id)" class="btn btn-success btn-block">Chat I'm Online</a>
                        <a :href="'/home/messages/create/' +bid.tutor_id" class="btn btn-primary btn-block">Message</a></td>
                    <td><a :href="'/home/account/scholar-profile/' +bid.tutor_id">{{ bid.tutor.name }}</a></td>
                    <td><a :href="'/home/account/scholar-profile/' +bid.tutor_id"> <img src="/img/4halfstars.png" />{{ bid.tutorratings }} reviews </a></td>
                    <td>
                        <strong>${{ bid.amount }}</strong>
                    </td>
                    <td>{{ bid.homedate | duedate }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    import Vue from 'vue';
    import Notifications from 'vue-notification'
    Vue.use(Notifications)
    import { mapGetters } from 'vuex'
    export default {
        data() {
            return {
                tutorbids: [],
                ratings: '',
                paypal: ''
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
            Echo.private(`bids.${this.orderdetails.id}`)
            .listen('BidsUpdated', (e) => {
                this.fetchBids()
            });
        },
        methods: {
            fetchBids(){
                axios.get('/home/bids/' + this.orderdetails.id)
                .then(response => {
                    this.tutorbids = response.data
                })
            },
            clickChat: function (tutor_id) {
                jqcc.cometchat.chatWith(tutor_id);
            }
        },
        mounted() {
            this.fetchBids()
            /*
            setInterval(function () {
                axios.get('/cometchat/cometchat_getid.php?userid=' +this.orderdetails.tutor_id)
                    .then(response => this.useronline = response.data.s);
            }.bind(this), 2000); */
        }
    }

</script>
