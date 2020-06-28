<template>
<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-info fa-fw"></i> Place a Bid
    </div>
    <div class="panel-body">
        <form name="form" method="post" submit.prevent="submitbid()">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td> <strong>Amount you will charge($)</strong> <em>A 10% transaction fee will be added to your bid</em>
                    </td>
                    <td>
                    <div class="form-group">
                        <input class="form-control" type="text" name="amount" v-model="amount" id="amount" required>
                    </div>
                    </td>
                </tr>
            </table>
            <input type="hidden" value="" name="orderid">
            <input type="hidden" value="" name="budget">
            <button id="confirmbid" type="submit" class="btn btn-danger">Place bid</button>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Confirm Bid</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                orderrevisions: [],
                amount: ''
            }
        },
        created(){
            //axios.post('/account/addbid');
            //action="/account/addbid"
        },
        methods: {
            submitbid(){
                $('#confirm').modal({ backdrop: 'static', keyboard: false })
                .one('click', '#delete', function (e) {
                    //delete function
                    console.log('Deleted');                    
                });
            }
        }
    }
</script>
