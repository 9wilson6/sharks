<template>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Scholar</th>
                <th>Rating</th>
                <th>Bid Amt + 10% fee</th>
                <th>Payment link</th>
                <th>Completion Time (Pacific Time)</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(bid, index) in tutorbids" :key="index">
                <td><a v-bind:href="'/account/scholarprofile/' +bid.tutor_id">{{ bid.tutor }}</a></td>
                <td><a v-bind:href="'/account/scholarprofile/' +bid.tutor_id">                
                <img src="/img/4halfstars.png" /> {{ ratings }} reviews
            </a></td>
                <td>

                <strong>${{ bid.amount }}</strong>
                <a v-if="bid.tutor_id == userloggedin" onclick="return confirm('Do you really want to Delete this bid?');" v-bind:href="'/account/delete-bid/' +bid.id"><strong>Delete bid</strong></a>

                </td>
                <td><strong>http://127.0.0.1:8000/account/order-payment/8844/1</strong></td>
                <td>{{ bid.homedate | duedate }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>    
    export default {
        props: ['orderidd', 'userloggedin'],

        data() {
            return {
                tutorbids: [],
                ratings: ''
            }
        },
        
        filters: {
            duedate(date){
                return moment(date).fromNow();
            }
        },
        mounted(){
            setInterval(function () {
                axios.get('/account/api/tutorbids/' +this.orderidd.id)
                  .then(response => this.tutorbids = response.data);
                axios.get('/account/api/ratings/' +this.orderidd.tutor_id)
                  .then(response => this.ratings = response.data);
            }.bind(this), 800);            
        }
    }
</script>