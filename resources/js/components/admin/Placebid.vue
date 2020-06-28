<template>
<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-info fa-fw"></i> Place a Bid
    </div>
    <div class="panel-body">
        <form name="form" method="post" action="/account/addbid">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td> <strong>Amount you will charge($)</strong> <em>A 10% transaction fee will be added to your bid</em>
                    </td>
                    <td>
                    <div class="form-group">
                        <input class="form-control" type="text" name="amount" id="amount" required>
                    </div>
                    </td>
                </tr>
            </table>
            <input type="hidden" value="" name="orderid">
            <input type="hidden" value="" name="budget">
            <button type="submit" class="btn btn-danger">Place bid</button>
        </form>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                orderrevisions: []
            }
        },
        created(){
            axios.post('/account/addbid');
        }
    }
</script>
