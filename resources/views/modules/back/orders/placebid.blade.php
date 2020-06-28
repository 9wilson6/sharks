<div class="panel panel-default">
    <div class="panel-heading"> <i class="fa fa-info fa-fw"></i> Place a Bid
    </div>
    <div class="panel-body">
        <form name="form" method="post" action="{{ url('/account/addbid') }}">
        {{ csrf_field() }}
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td> <strong>Amount you will charge($)</strong> <em>A 10% transaction fee will be added to your bid</em>
                    </td>
                    <td>
                    <div class="form-group @if ($errors->has('amount')) has-error @endif">
                        <input class="form-control" type="text" name="amount" id="amount" required>
                        @if ($errors->has('amount')) <p class="help-block">{{ $errors->first('amount') }}</p> @endif
                    </div>
                    </td>
                </tr>
            </table>
            <input type="hidden" value="{{ $order_id->id }}" name="orderid">
            <input type="hidden" value="{{ $order_id->budget }}" name="budget">
            <button type="submit" class="btn btn-danger">Place bid</button>
        </form>
    </div>
</div>
