<template>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-info fa-fw"></i> Place a Bid
            </div>
            <div class="panel-body">
                <form name="form" method="post" :action="'/account/bids/add/'+orderdetails.id">
                <input type="hidden" name="_token" :value="csrf">
                    <table class="table table-bordered table-hover table-striped">
                        <tr>
                            <td><strong>Amount you will charge($)</strong> <em>A 10% transaction fee will be added to your bid</em></td>
                            <td>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="amount" id="amount" required>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-danger">Place bid</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails'
        })
    },
    mounted(){}
}
</script>
