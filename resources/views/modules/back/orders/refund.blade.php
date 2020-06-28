<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Refund Order
    </div>
    <div class="panel-body">
        <form name="form" method="post" action="{{ url('/account/refund-order') }}">
        {{ csrf_field() }}
        <input type="hidden" value="{{ $order_id->id }}" name="order_id">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td>Project #</td>
                    <td>{{ $order_id->subject }}</td>
                </tr>                
                <tr>
                    <td>Reason for refund</td>
                    <td>
                        <div>
                            <textarea name="reason" id="reason" class="form-control"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <button class="btn btn-danger" type="submit" name="submit" value="Submit">Refund order</button>
        </form>
    </div>
</div>
