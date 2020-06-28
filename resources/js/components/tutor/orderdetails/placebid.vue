<template>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-info fa-fw"></i> Place a Bid
            </div>
            <div class="panel-body">
                <form id="bidSubmitForm" name="form" method="post" :action="'/account/bids/add/'+orderdetails.id">
                    <input type="hidden" name="_token" :value="csrf">
                    <table class="table table-bordered table-hover table-striped">
                        <tr>
                            <td><strong>Amount you will charge($)</strong> <em>A 10% transaction fee will be added to your bid</em></td>
                            <td>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="amount" v-model="bidamount" id="bidamount" required>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <button :disabled="bidamount < 5" @click.prevent="submitbid()" class="btn btn-danger">Place bid</button>
                </form>
                <div class="modal fade" id="confirmbid">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Bid for this order</h4>
                            </div>
                            <div class="modal-body">
                                <p>(Please note that by placing your bid on this order, you are confirming that you will complete the order for the set price within the set deadline. Failure to deliver the order 10 minutes later within the set deadline will lead to 10% fine)</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">        
                                        <tbody>                                            
                                            <tr>
                                                <td><strong>Subject</strong></td>
                                                <td>{{ orderdetails.subject }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Level</strong></td>
                                                <td>{{ orderdetails.level }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pages</strong></td>
                                                <td>{{ orderdetails.numpages }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Deadline (Pacific Time)</strong></td>
                                                <td>{{ orderdetails.homedate | datFormat }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Paid to you</strong></td>
                                                <td>{{ paidto }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Your bid</strong></td>
                                                <td>{{ yourbid }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button :disabled="confirmbutton" id="sendbidTobackEnd" type="button" class="btn btn-success">Confirm Bid</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            bidamount: '',
            paidto: '0.00',
            confirmbutton: false
        }
    },    
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails'
        }),
        yourbid(){
            var formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
            })
            return formatter.format(this.bidamount)
        }
    },
    filters: {
        datFormat: function(dat){
            return moment(dat).format('LLLL');
        }
    },
    methods: {
        submitbid(){
            this.paidtoyou().then((resp) => {

                var formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                })
                this.paidto = formatter.format(resp)
                $('#confirmbid').modal({ backdrop: 'static', keyboard: false })
                .one('click', '#sendbidTobackEnd', function (e) {
                    //Disable confirm button
                    this.confirmbutton = true
                    $('#bidSubmitForm').submit();
                    //console.log('BidPlaced');                    
                });
            })            
        },
        async paidtoyou() {
            try {
                let response = await axios.get('/amount/you/get/' + this.bidamount);                
                return response.data.amount
            } catch(error) {
                // error
            }
        }
    }
}
</script>
